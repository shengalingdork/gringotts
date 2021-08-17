<?php

namespace App\Http\Repositories;

use App\Models\Record;
use App\Http\Repositories\DateRepository;
use Illuminate\Support\Facades\DB;

class RecordRepository
{
  protected $__date;

  public function __construct()
  {
    $this->__date = app(DateRepository::class);
  }

  public function all()
  {
    try {
      return Record::all();
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

  public function find($id)
  {
    try {
      return Record::findOrFail($id);
    } catch (\Exception $e) {
      return false;
    }
  }

  public function create($params)
  {
    try {
      return Record::create($params);
    } catch (\Exception $e) {
      return false;
    }
  }

  public function save($params, $id)
  {
    try {
      $record = Record::findOrFail($id);

      $record->category_id = $params->category_id;
      $record->item = $params->item;
      $record->cost = $params->cost;
      $record->recorded_at = $params->recorded_at;

      if ($params->scheme_id) {
        $record->scheme_id = $params->scheme_id;
      }

      $record->save();
      return $record;
    } catch (\Exception $e) {
      return false;
    }
  }

  public function destroy($id)
  {
    try {
      Record::destroy($id);
      return;
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

  public function format($record)
  {
    // mainly for loans (expenses)
    $record->relation = $record->relator()->first();
    if ($record->relation) {
      $record->relation = $record->relation->record()->first();
    }

    // mainly for transactions
    if ($record->scheme_id) {
      $record->scheme = $record->scheme()->first();
      $record->scheme->scheme_group = $record->scheme->schemeGroup()->first();
      $record->category = $record->scheme->category()->first();
    } else {
      $record->category = $record->category()->first();
    }

    return $record;
  }

  public function getIndexByRecordDate($date)
  {
    $date = explode('-', $date);
    $recordDates = $this->getDates();
    $index = array_search(
      $date[1] . '-' . $date[0],
      array_column($recordDates, 'MMYYYY')
    );
    return $index + 1;
  }

  public function getDates()
  {
    $select = DB::raw('YEAR(recorded_at) as year, MONTH(recorded_at) as month');
    $dates = Record::select($select)
      ->groupBy('year', 'month')
      ->orderBy(DB::raw('year, month'), 'asc')
      ->get();

    $array = [];

    foreach ($dates as $key => $date) {
      array_push($array, array(
        "id" => $key + 1,
        "month" => $date->month,
        "year" => $date->year,
        "full" => $date->year . '-' . $this->__date->formatMonth($date->month) . '-01 00:00:00',
        "MMYYYY" => $this->__date->formatMonth($date->month) . '-' . $date->year
      ));
    }

    return $array;
  }

  public function getTransactionsPerMonthYear($month, $year)
  {
    $ids = array();

    $records = DB::table('records')
      ->select('records.*')
      ->leftJoin('schemes', 'records.scheme_id', '=', 'schemes.id')
      ->where(function ($query) {
        $query->where('records.category_id', '>', 2)
          ->orWhere('schemes.category_id', '>', 2);
      })
      ->whereMonth('recorded_at', $month)
      ->whereYear('recorded_at', $year)
      ->orderBy('recorded_at', 'asc')
      ->get();

    foreach ($records as $record) {
      array_push($ids, $record->id);
    }

    return Record::whereIn('id', $ids)->get();
  }

  public function getLoansPerMonthYear($month, $year)
  {
    $ids = array();

    $records = DB::table('records')
      ->select('records.*')
      ->leftJoin('schemes', 'records.scheme_id', '=', 'schemes.id')
      ->where(function ($query) {
        $query->where('records.category_id', '<', 3)
          ->orWhere('schemes.category_id', '<', 3);
      })
      ->whereMonth('recorded_at', $month)
      ->whereYear('recorded_at', $year)
      ->orderBy('recorded_at', 'asc')
      ->get();

    foreach ($records as $record) {
      array_push($ids, $record->id);
    }

    return Record::whereIn('id', $ids)->get();
  }

  public function getTotalComputation($records)
  {
    $totalSource = 0;
    $totalExpenses = 0;

    foreach ($records as $record) {
      if ($record->category->kind === 'source') {
        $record->beforeTotalSource = $totalSource;
        $totalSource = $totalSource + $record->cost;
        $record->totalSource = $totalSource;
      } else {
        $record->beforeTotalExpense = $totalExpenses;
        $totalExpenses = $totalExpenses + $record->cost;
        $record->totalExpense = $totalExpenses;
      }
    }

    return [
      "source" => $totalSource,
      "expenses" => $totalExpenses
    ];
  }

  public function getTotalBalanceToLatestMonthYear($month, $year)
  {
    $balance = 0;
    $month = $month + 1;
    $date = $year . '-' . $month . '-1';
    $records = Record::where('recorded_at', '<', $date)->get();

    if (count($records) === 0) return $balance;

    foreach ($records as $record) {
      $record = $this->format($record);
    }

    $computation = $this->getTotalComputation($records);

    return $computation['source'] - $computation['expenses'];
  }

  public function destroyBySchemeId($id)
  {
    return Record::where('scheme_id', $id)->delete();
  }

  public function getByScheme($id)
  {
    return Record::where('scheme_id', $id)
      ->orderBy(DB::raw('YEAR(recorded_at), MONTH(recorded_at)'), 'asc')
      ->get();
  }
}
