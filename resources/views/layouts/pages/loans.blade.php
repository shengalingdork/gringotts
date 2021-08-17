@extends('layouts.elements.app')

@section('content')
<div class="container-fluid">
  <h2>Loans</h2>
  @if (!count($loanDates))
  <div class="alert alert-light">
    You have no loans yet, which is good. Add one in <a href="/records" style="color:#0079a1">records</a> if you already have one. 
  </div>
  @else
  @include('layouts.loans.navigation')
  <div class="table-responsive">
    <table class="table table-hover table-striped">
      <thead>
        <tr class="table-active d-flex table-sm text-center">
          <th scope="col" class="col">Date</th>
          <th scope="col" class="col">Status</th>
          <th scope="col" class="col-5">Name</th>
          <th scope="col" class="col-2">Amount</th>
          <th scope="col" class="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($loans as $loan)
        <tr id="loan-{{ $loan->id }}" class="d-flex text-center">
          <td class="col">{{ $loan->recorded_at }}</td>
          <td class="col h3">
            @if ($loan->cost === $loan->paid)
            <span class="badge badge-pill badge-success">
              <i class="fas fa-check-circle"></i>
            </span>
            @else
            <span class="badge badge-pill badge-warning">
              <i class="fas fa-times-circle"></i>
            </span>
            @endif
          </td>
          <td class="col-5 loan-name">{{ $loan->item }}</td>
          <td class="col-2">&#8369;{{ $loan->cost }}</td>
          <td class="col">
            <button id="view-loan-{{ $loan->id }}" class="btn btn-outline-primary btn-sm m-1 view-loan-btn" data-target="#view-loan{{ $loan->id }}-modal" data-toggle="modal">
              <span class="oi oi-grid-two-up"></span>
            </button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @endif
</div>

@if (count($loanDates))
@foreach ($loans as $loan)
<x-loans.view-modal :loan="$loan" />
@endforeach
@endif

@endsection