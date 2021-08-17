<div class="card border-light mb-3">
  <div class="card-header">
    <h5>Scheme Groups</h5>
  </div>
  <div class="card-body">
    <ul id="scheme-group-list" class="list-group teammatesList">
      @if (!count($categories))
      <div class="alert alert-light">
        There are no scheme groups yet.
      </div>
      @else
      @foreach ($schemeGroups as $group)
      <li id="scheme-group-{{ $group->id }}" class="list-group-item">
        <div class="row">
          <div class="col-2">
            <h2 class="text-center">
              <i class="fas fa-{{ $group->icon_name }}"></i>
            </h2>
          </div>
          <div class="col">
            <h6>{{ $group->name }}</h6>
          </div>
        </div>
        @if ( $group->id > 3)
        <div class="row">
          <div class="col">
            <div class="float-right">
              <button id="edit-scheme-group-{{ $group->id }}" class="btn btn-outline-success btn-sm edit-scheme-group-btn">
                <span class="oi oi-pencil"></span>
              </button>
              <button id="delete-scheme-group-{{ $group->id }}" class="btn btn-outline-danger btn-sm delete-scheme-group-btn" data-target="#delete-scheme-group-modal" data-toggle="modal">
                <span class="oi oi-trash"></span>
              </button>
            </div>
          </div>
        </div>
        @endif
      </li>
      @endforeach
      @endif
      <li class="list-group-item">
        <form id="scheme-group-form">
          <div class="form-group">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
              <div class="col">
                <div style="width:100%" class="float-right pr-2">
                  <input id="scheme-group-name" type="text" class="form-control mb-2 new-scheme-group-input" placeholder="Enter scheme group name" name="name" required>
                  <input id="scheme-group-icon-name" type="text" class="form-control mb-2 new-scheme-group-input" placeholder="Enter icon name" name="icon_name" required>
                </div>
              </div>
              <div class="col-1">
                <div class="float-right" style="display: flex;">
                  <button class="btn btn-primary btn-sm">
                    <span class="oi oi-plus"></span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </li>
    </ul>
  </div>
</div>

<x-schemeGroups.delete-modal />