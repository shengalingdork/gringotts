<?php

namespace App\Http\Repositories;

use App\Models\Record;
use Illuminate\Support\Facades\DB;

class LoanRepository extends RecordRepository
{
  public function all()
  {
    try {
      return Record::where('category_id', 1)->get();
    } catch (\Exception $e) {
      return false;
    }
  }

  public function format($record)
  {
    $total = 0;
    $record->relations = $record->relations()->get();
    foreach ($record->relations as $key => $related) {
      $related = $related->relatedRecord()->first();
      $total = $total + $related->cost;
      $related->balance = $record->cost - $total;
      $record->relations[$key] = $related;
    }

    $record->paid = $total;
    return $record;
  }

  public function getDates()
  {
    $select = DB::raw('YEAR(recorded_at) as year, MONTH(recorded_at) as month');
    $dates = Record::select($select)
      ->where('category_id', 1)
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

  public function getLoansPerMonthYear($month, $year)
  {
    $ids = array();

    $records = DB::table('records')
      ->select('records.*')
      ->leftJoin('schemes', 'records.scheme_id', '=', 'schemes.id')
      ->where('records.category_id', '=', 1)
      ->whereMonth('recorded_at', $month)
      ->whereYear('recorded_at', $year)
      ->orderBy('recorded_at', 'asc')
      ->get();

    foreach ($records as $record) {
      array_push($ids, $record->id);
    }

    return Record::whereIn('id', $ids)->get();
  }
}
