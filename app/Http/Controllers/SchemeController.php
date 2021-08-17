<?php

namespace App\Http\Controllers;

use App\Http\Repositories\SchemeRepository;
use App\Http\Repositories\SchemeGroupRepository;
use App\Http\Repositories\RecordRepository;
use Illuminate\Http\Request;

class SchemeController extends Controller
{
  protected $__scheme;
  protected $__schemeGroup;
  protected $__record;

  public function __construct()
  {
    $this->__scheme = app(SchemeRepository::class);
    $this->__schemeGroup = app(SchemeGroupRepository::class);
    $this->__record = app(RecordRepository::class);
  }

  public function index()
  {
    $schemeGroups = $this->__schemeGroup->all();
    $schemes = $this->__scheme->all();

    foreach ($schemeGroups as $schemeGroup) {
      $schemesForThisGroup = [];
      foreach ($schemes as $scheme) {
        if ($schemeGroup->id === $scheme->scheme_group_id) {
          $scheme = $this->__scheme->format($scheme);
          array_push($schemesForThisGroup, $scheme);
        }
      }
      $schemeGroup->schemes = $schemesForThisGroup;
    }

    return view('layouts.pages.schemes', [
      'schemeGroups' => $schemeGroups
    ]);
  }

  public function show($id)
  {
    $scheme = $this->get($id);

    if (!$scheme) return redirect('schemes');

    $records = $this->__record->getByScheme($id);

    $total = 0;
    foreach ($records as $record) {
      $record->recorded_at = explode(' ', $record->recorded_at)[0];
      $total = $total + $record->cost;
      $record->balance = $scheme->cost - $total;
    }

    return view('layouts.pages.scheme', [
      'scheme' => $scheme,
      'records' => $records,
      'total' => $total
    ]);
  }

  public function store(Request $request)
  {
    $params = [
      'scheme_group_id' => $request->scheme_group_id,
      'category_id' => $request->category_id,
      'item' => $request->item,
      'cost' => $request->cost,
      'balance' => $request->cost,
      'start_at' => $request->start_at,
      'end_at' => $request->end_at
    ];

    $this->__scheme->create($params);
    return redirect('schemes');
  }

  public function update(Request $request, $id)
  {
    $this->__scheme->save($request, $id);
    $this->__scheme->updateBalance($id);
    return redirect('schemes');
  }

  public function destroy($id)
  {
    $this->__record->destroyBySchemeId($id);
    $this->__scheme->destroy($id);
    return redirect('schemes');
  }

  public function getAll()
  {
    $schemes = $this->__scheme->all();

    foreach ($schemes as $scheme) {
      $scheme = $this->__scheme->format($scheme);
    }

    return $schemes;
  }

  public function get($id)
  {
    $scheme = $this->__scheme->find($id);
    if (!$scheme) return;
    return $this->__scheme->format($scheme);
  }

  public function getCompletion($id)
  {
    $scheme = $this->get($id);
    if (!$scheme) return;
    return $this->__scheme->completion($scheme);
  }
}
