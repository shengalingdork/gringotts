@extends('layouts.elements.app')

@section('content')
<div class="container-fluid">
  <h2>Schemes</h2>
  @if (!count($schemeGroups))
  <div class="alert alert-light">
    There are no scheme groups yet. Head over to <a href="/lookups" style="color:#0079a1">look-ups</a> to add one.
  </div>
  @else
  @foreach($schemeGroups as $schemeGroup)
  <div id="scheme-group-{{ $schemeGroup->id }}" class="card border-light my-4">
    <div class="card-header h3">
      <span>{{ $schemeGroup->name }}</span>
      <i class="fas fa-{{ $schemeGroup->icon_name }}"></i>
      <div class="float-right">
        <button id="add-scheme-group-{{ $schemeGroup->id }}" class="btn btn-primary btn-sm m-1 add-scheme-btn" data-toggle="modal" data-target="#add-scheme-modal">
          <span class="oi oi-plus"></span>
        </button>
      </div>
    </div>
    <div class="card-body">
      @if (count($schemeGroup->schemes) === 0)
      <div class="alert alert-light">
        There are no schemes for this group.
      </div>
      @else
      <div class="table-responsive">
        <table class="table table-hover table-striped">
          <thead>
            <tr class="table-active d-flex table-sm text-center">
              <th scope="col" class="col">Status</th>
              <th scope="col" class="col">Category</th>
              <th scope="col" class="col-3">Name</th>
              <th scope="col" class="col">Amount</th>
              <th scope="col" class="col">Balance</th>
              <th scope="col" class="col-2">Planned Duration</th>
              <th scope="col" class="col-2">Completion Duration</th>
              <th scope="col" class="col">Actions</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          @foreach ($schemeGroup->schemes as $scheme)
          <tr id="scheme-{{ $scheme->id }}" class="d-flex text-center">
            <td class="col h3">
              @if ((int)$scheme->balance === 0)
              <span class="badge badge-pill badge-success">
                <i class="fas fa-check-circle"></i>
              </span>
              @else
              <span class="badge badge-pill badge-warning">
                <i class="fas fa-times-circle"></i>
              </span>
              @endif
            </td>
            <td class="col h3">
              <span class="badge badge-pill badge-{{ $scheme->category->kind === 'source' ? 'success' : 'danger' }} m-1">
                <i class="fas fa-{{ $scheme->category->icon_name }}"></i>
              </span>
            </td>
            <td class="col-3 text-left scheme-name">
              <a href="/schemes/{{ $scheme->id }}">{{ $scheme->item }}</a>
            </td>
            <td class="col">&#8369;{{ $scheme->cost }} (&#8369;{{ round($scheme->cost/$scheme->durationInMonths, 2) }}/mo)</td>
            <td class="col">&#8369;{{ $scheme->balance }}</td>
            <td class="col-2">{{ $scheme->duration }} ({{ $scheme->durationInMonths }}mos)</td>
            <td class="col-2">{{ $scheme->completion['count'] }} mo(s)</td>
            <td class="col">
              <button id="edit-scheme-{{ $scheme->id }}" class="btn btn-outline-warning btn-sm m-1 edit-scheme-btn" data-target="#edit-scheme-modal" data-toggle="modal">
                <span class="oi oi-pencil"></span>
              </button>
              <button id="delete-scheme-{{ $scheme->id }}" class="btn btn-outline-danger btn-sm m-1 delete-scheme-btn" data-target="#delete-scheme-modal" data-toggle="modal">
                <span class="oi oi-trash"></span>
              </button>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
      @endif
    </div>
  </div>
  @endforeach
  @endif
</div>

<x-schemes.add-modal />
<x-schemes.edit-modal />
<x-schemes.delete-modal />

@endsection