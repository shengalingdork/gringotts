@extends('layouts.elements.app')

@section('content')
<div class="container-fluid">
  <h2>Look-ups</h2>
  <div class="row mt-4">
    <div class="col-xl">
      @include('layouts.lookups.categories')
    </div>
    <div class="col-xl">
      @include('layouts.lookups.schemeGroups')
    </div>
  </div>
</div>
@endsection