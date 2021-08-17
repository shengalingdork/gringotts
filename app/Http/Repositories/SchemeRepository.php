<?php

namespace App\Http\Repositories;

use App\Models\Scheme;

class SchemeRepository
{
  protected $__record;
  protected $__date;

  public function __construct()
  {
    $this->__record = app(RecordRepository::class);
    $this->__date = app(DateRepository::class);
  }

  public function all()
  {
    try {
      return Scheme::all();
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

  public function find($id)
  {
    try {
      return Scheme::findOrFail($id);
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

  public function create($params)
  {
    try {
      return Scheme::create($params);
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

  public function save($params, $id)
  {
    try {
      $scheme = Scheme::findOrFail($id);

      $scheme->scheme_group_id = $params->scheme_group_id;
      $scheme->category_id = $params->category_id;
      $scheme->item = $params->item;
      $scheme->cost = $params->cost;
      $scheme->start_at = $params->start_at;
      $scheme->end_at = $params->end_at;

      $scheme->save();
      return;
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

  public function destroy($id)
  {
    try {
      Scheme::destroy($id);
      return;
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

  public function format($scheme)
  {
    $startAt = $this->__date->format($scheme->start_at, 'F Y');
    $endAt = $this->__date->format($scheme->end_at, 'F Y');
    $scheme->duration = $startAt . ' - ' . $endAt;
    $scheme->durationInMonths = $this->__date->computeDifference($scheme->start_at, $scheme->end_at) + 1;

    $scheme->category = $scheme->category()->first();
    $scheme->scheme_group = $scheme->schemeGroup()->first();

    $scheme->completion = $this->completion($scheme);

    return $scheme;
  }

  public function updateBalance($id)
  {
    $scheme = $this->find($id);
    if (!$scheme) return;
    $scheme = $this->format($scheme);
    $total = $scheme->completion['total'];

    $tempScheme = $this->find($id);
    $tempScheme->balance = $tempScheme->cost - $total;

    try {
      $tempScheme->save();
      return;
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

  public function completion($scheme)
  {
    $records = $this->__record->getByScheme($scheme->id);

    $total = 0;
    foreach ($records as $record) {
      $total = $total + $record->cost;
    }

    return [
      "cost" => $scheme->cost,
      "duration" => $scheme->durationInMonths,
      "monthlyCost" => round($scheme->cost / $scheme->durationInMonths, 2),
      "count" => count($records),
      "total" => $total,
      "balance" => $scheme->balance
    ];
  }
}
