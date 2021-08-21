<?php

namespace App\Http\Controllers;

use App\Http\Repositories\LoanRepository;
use App\Http\Repositories\DateRepository;

class LoansController extends Controller
{
  protected $__loan;
  protected $__date;

  public function __construct()
  {
    $this->__loan = app(LoanRepository::class);
    $this->__date = app(DateRepository::class);
  }

  public function index($id = null)
  {
    $dates = $this->__loan->getDates();

    if (!count($dates)) {
      return view('layouts.pages.loans', [
        'loanDates' => [],
      ]);
    }

    if ($id && $id > count($dates)) return redirect('loans');

    $currentDate = $id ? $dates[$id - 1] : end($dates);
    $year = $currentDate['year'];

    $loans = $this->__loan->getLoansPerYear($year);

    foreach ($loans as $loan) {
      $loan = $this->__loan->format($loan);
    }

    return view('layouts.pages.loans', [
      'loanDates' => array_reverse($dates),
      'selectedDate' => $year,
      'loans' => $loans
    ]);
  }

  public function show($id)
  {
    $loan = $this->__loan->find($id);

    if (!$loan) return redirect('loans');

    $month = $this->__date->getMonth($loan->recorded_at);
    $year = $this->__date->getYear($loan->recorded_at);
    $dates = $this->__loan->getDates();

    $id = null;
    foreach ($dates as $date) {
      if ($date['month'] === $month && $date['year'] === $year) {
        $id = $date['id'];
        break;
      }
    }

    return $id ? redirect('loans/' . $id) : redirect('loans');
  }

  public function getAll()
  {
    $loans = $this->__loan->all();

    if (!$loans) return;

    foreach ($loans as $loan) {
      $loan = $this->__loan->format($loan);
    }

    return $loans;
  }

  public function get($id)
  {
    $loan = $this->__loan->find($id);

    if (!$loan) return;

    return $this->__loan->format($loan);
  }
}
