@extends('layouts.elements.app')

@section('content')
<div class="container-fluid">
  <h2>Records</h2>
  @if (!count($recordDates))
  <div class="alert alert-light">
    You have no records yet! Add your first entry here.
    <button class="btn btn-primary btn-sm add-record-btn" data-target="#add-record-modal" data-toggle="modal">
      <span class="oi oi-plus"></span>
    </button>
  </div>
  @else
  @include('layouts.records.navigation')
  @include('layouts.records.alert')
  @include('layouts.records.summary')
  @include('layouts.records.transactions')
  @include('layouts.records.loans')
  @endif
</div>

<x-records.add-modal />
<x-records.edit-modal />
<x-records.delete-modal />

@endsection