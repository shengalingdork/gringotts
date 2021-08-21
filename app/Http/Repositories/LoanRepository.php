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
    $select = DB::raw('YEAR(recorded_at) as year');
    $dates = Record::select($select)
      ->where('category_id', 1)
      ->groupBy('year')
      ->orderBy('year', 'asc')
      ->get();

    $array = [];

    foreach ($dates as $key => $date) {
      array_push($array, array(
        "id" => $key + 1,
        "year" => $date->year
      ));
    }

    return $array;
  }

  public function getLoansPerYear($year)
  {
    $ids = array();

    $records = DB::table('records')
      ->select('records.*')
      ->leftJoin('schemes', 'records.scheme_id', '=', 'schemes.id')
      ->where('records.category_id', '=', 1)
      ->whereYear('recorded_at', $year)
      ->orderBy('recorded_at', 'asc')
      ->get();

    foreach ($records as $record) {
      array_push($ids, $record->id);
    }

    return Record::whereIn('id', $ids)->get();
  }
}
