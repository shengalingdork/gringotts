<?php

namespace App\Http\Controllers;

use App\Http\Repositories\RecordRepository;
use App\Http\Repositories\SchemeRepository;
use App\Http\Repositories\CategoryRepository;
use App\Http\Repositories\SchemeGroupRepository;
use App\Http\Repositories\DateRepository;
use App\Http\Repositories\RecordRelationRepository;

use Illuminate\Http\Request;

class RecordsController extends Controller
{
  protected $__record;
  protected $__scheme;
  protected $__category;
  protected $__schemeGroup;
  protected $__date;
  protected $__recordRelation;

  public function __construct()
  {
    $this->__record = app(RecordRepository::class);
    $this->__scheme = app(SchemeRepository::class);
    $this->__category = app(CategoryRepository::class);
    $this->__schemeGroup = app(SchemeGroupRepository::class);
    $this->__date = app(DateRepository::class);
    $this->__recordRelation = app(RecordRelationRepository::class);
  }

  public function index()
  {
    return $this->__record->all();
  }

  public function show($id)
  {
    $record = $this->__record->find($id);

    if (!$record) return false;

    return $this->__record->format($record);
  }

  public function store(Request $request)
  {
    $params = [
      'category_id' => $request->category_id,
      'item' => $request->item,
      'cost' => $request->cost,
      'recorded_at' => $request->recorded_at
    ];

    if ($request->scheme_id) {
      $params['scheme_id'] = $request->scheme_id;
    }

    $record = $this->__record->create($params);

    if (!$record) redirect('records');

    if ($request->scheme_id) {
      $this->__scheme->updateBalance($request->scheme_id);
    }

    if ((int)$request->category_id === 2) {
      $this->__recordRelation->create([
        'record_id' => $request->loan_id,
        'related_record_id' => $record->id
      ]);
    }

    $index = $this->__record->getIndexByRecordDate($request->recorded_at);
    return redirect('/records/' . $index);
  }

  public function update(Request $request, $id)
  {
    $record = $this->__record->save($request, $id);

    if (!$record) redirect('records');

    if ($request->scheme_id) {
      $this->__scheme->updateBalance($request->scheme_id);
    }

    if ((int)$request->category_id === 2) {
      $this->__recordRelation->saveByRelatedRecordId([
        'record_id' => (int)$request->loan_id
      ], $id);
    }

    $index = $this->__record->getIndexByRecordDate($request->recorded_at);
    return redirect('/records/' . $index);
  }

  public function destroy($id)
  {
    $record = $this->__record->find($id);

    if ($record) {
      $this->__record->destroy($id);
    }

    if ($record->scheme_id) {
      $this->__scheme->updateBalance($record->scheme_id);
    }

    if ($record->category_id === 2) {
      $this->__recordRelation->destroyByRelatedRecordId($record->id);
    }

    $index = $this->__record->getIndexByRecordDate($record->recorded_at);
    return redirect('/records/' . $index);
  }

  public function fetchDateByIndex($id)
  {
    $dates = $this->__record->getDates();

    $date = null;

    foreach ($dates as $d) {
      if ($d['id'] === (int)$id) {
        $date = $d['full'];
      }
    }

    return json_encode($date);
  }

  public function fetchByDateIndex($id = null)
  {
    $dates = $this->__record->getDates();

    if (!count($dates)) {
      return view('layouts.pages.records', [
        'recordDates' => [],
      ]);
    }

    if ($id && $id > count($dates)) return redirect('records');

    $currentDate = $id ? $dates[$id - 1] : end($dates);
    $month = $currentDate['month'];
    $year = $currentDate['year'];

    $records = [];

    $transactions = $this->__record->getTransactionsPerMonthYear($month, $year);

    foreach ($transactions as $transaction) {
      $transaction = $this->__record->format($transaction);
      array_push($records, $transaction);
    }

    $loans = $this->__record->getLoansPerMonthYear($month, $year);

    foreach ($loans as $loan) {
      $loan = $this->__record->format($loan);
      array_push($records, $loan);
    }

    $computation = $this->__record->getTotalComputation($records);

    $totalSource = $computation['source'];
    $totalExpenses = $computation['expenses'];

    $overallBalance = $this->__record->getTotalBalanceToLatestMonthYear($month, $year);

    $categories = $this->__category->all();
    $schemeGroups = $this->__schemeGroup->all();

    return view('layouts.pages.records', [
      'recordDates' => array_reverse($dates),
      'formattedSelectedDate' => $this->__date->format($currentDate['full'], 'F Y'),
      'selectedDate' => $currentDate['MMYYYY'],
      'transactions' => $transactions,
      'loans' => $loans,
      'categories' => $categories,
      'schemes' => $schemeGroups,
      'totalSource' => $totalSource,
      'totalExpenses' => $totalExpenses,
      'balance' => $totalSource - $totalExpenses,
      'overallBalance' => $overallBalance
    ]);
  }
}
