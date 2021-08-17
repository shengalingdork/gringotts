<div class="card border-light mb-3">
  <div class="card-header">
    <h5>Categories</h5>
  </div>
  <div class="card-body">
    <ul id="category-list" class="list-group teammatesList">
      @if (!count($categories))
      <div class="alert alert-light">
        There are no categories yet.
      </div>
      @else
      @foreach ($categories as $category)
      <li id="category-{{ $category->id }}" class="list-group-item">
        <div class="row">
          <div class="col-2">
            <h2 class="text-center">
              <i class="fas fa-{{ $category->icon_name }}"></i>
            </h2>
          </div>
          <div class="col">
            <h6>{{ $category->name }}</h6>
          </div>
          <div class="col-1">
            <div class="float-right">
              <span class="
                    badge
                    badge-pill
                    badge-{{ $category->kind === 'source' ? 'success' : 'warning' }}
                  " style="font-size:90%;">
                {{ $category->kind }}
              </span>
            </div>
          </div>
        </div>
        @if ($category->id > 21)
        <div class="row">
          <div class="col">
            <div class="float-right">
              <button id="edit-category-{{ $category->id }}" class="btn btn-outline-success btn-sm edit-category-btn">
                <span class="oi oi-pencil"></span>
              </button>
              <button id="delete-category-{{ $category->id }}" class="btn btn-outline-danger btn-sm delete-category-btn" data-target="#delete-category-modal" data-toggle="modal">
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
        <form id="category-form">
          <div class="form-group">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
              <div class="col">
                <div style="width:100%" class="float-right pr-2">
                  <input id="category-name" type="text" class="form-control mb-2 new-category-input" placeholder="Enter category name" name="name" required>
                  <input id="category-icon-name" type="text" class="form-control mb-2 new-category-input" placeholder="Enter icon name" name="icon_name" required>
                  <select id="category-kind" class="form-control custom-select mb-2" name="kind" required>
                    <option selected disabled value="">
                      Pick category kind
                    </option>
                    @foreach (['source', 'expenses'] as $value)
                    <option class="new-category-option" value="{{ $value }}">
                      {{ $value }}
                    </option>
                    @endforeach
                  </select>
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

<x-categories.delete-modal />