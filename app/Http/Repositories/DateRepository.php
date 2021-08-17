<?php

namespace App\Http\Repositories;

use Carbon\Carbon;

class DateRepository
{
  public function formatMonth($month)
  {
    if ($month < 10) return '0' . $month;
    return $month;
  }

  public function getMonth($date)
  {
    $d = Carbon::parse($date);
    return $d->month;
  }

  public function getYear($date)
  {
    $d = Carbon::parse($date);
    return $d->year;
  }

  public function format($date, $format)
  {
    $d = Carbon::createFromFormat('Y-m-d H:i:s', $date);
    return strtoupper($d->format($format));
  }

  public function computeDifference($date1, $date2)
  {
    $d1 = Carbon::createFromFormat('Y-m-d H:i:s', $date1);
    $d2 = Carbon::createFromFormat('Y-m-d H:i:s', $date2);
    return $d2->diffInMonths($d1);
  }
}
