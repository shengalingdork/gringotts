@extends('layouts.elements.app')

@section('content')
<div class="container-fluid">
  <div class="float-left" style="display:inline-block;width:60px;">
    <a class="btn btn-secondary" href="/schemes" role="button">
      <span class="oi oi-arrow-thick-left"></span>
    </a>
  </div>
  <h2>Scheme</h2>
  <div class="card border-light my-4">
    <div class="card-header h3">
      <span>{{ $scheme->item }}</span>
      <div class="float-right">
        <span>&#8369;{{ $scheme->cost }}</span>
      </div>
    </div>
    <div class="card-body">
      @if (count($records) === 0)
      <div class="alert alert-light">
        There are no records for this scheme yet.
      </div>
      @else
      <div class="table-responsive">
        <table class="table table-hover table-striped">
          <thead>
            <tr class="table-active d-flex table-sm text-center">
              <th scope="col" class="col">Date</th>
              <th scope="col" class="col">Amount</th>
              <th scope="col" class="col">Running Balance</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          @foreach ($records as $record)
          <tr class="d-flex text-center">
            <td class="col">{{ $record->recorded_at }}</td>
            <td class="col">&#8369;{{ $record->cost }} </td>
            <td class="col">&#8369;{{ $record->balance }}</td>
          </tr>
          @endforeach
          <tr class="d-flex text-center">
            <th scope="col" class="col">Total</td>
            <td class="col">&#8369;{{ $total }}</td>
            <td class="col"></td>
          </tr>
        </table>
      </div>
      @endif
    </div>
  </div>
</div>
@endsection