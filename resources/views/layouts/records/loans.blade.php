<div class="card my-4">
  <div class="card-header h3">
    <span>Loans</span>
  </div>
  <div class="card-body">
    @if (count($loans) === 0)
    <div class="alert alert-light">
      There are no loans on this month.
    </div>
    @else
    <div class="table-responsive">
      <table class="table table-hover table-striped">
        <thead>
          <tr class="table-active d-flex table-sm text-center">
            <th scope="col" class="col">Category</th>
            <th scope="col" class="col-6">Name</th>
            <th scope="col" class="col-2">Amount</th>
            <th scope="col" class="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($loans as $loan)
          <tr id="record-{{ $loan->id }}" class="d-flex">
            <td class="col text-center h3">
              <span class="badge badge-pill badge-{{ $loan->category->kind === 'source' ? 'success' : 'danger' }}" title="{{ $loan->category->name }}">
                <i class="fas fa-{{ $loan->category->icon_name }}"></i>
              </span>
            </td>
            <td class="col-6 record-name">
              @if ($loan->category_id === 2)
              {{ $loan->relation->item }}
              @else
              <a href="/loan/{{ $loan->id }}">{{ $loan->item }}</a>
              @endif
            </td>
            <td class="col-2 text-center">&#8369;{{ $loan->cost }}</td>
            <td class="col-2 text-center">
              <button id="edit-record-{{ $loan->id }}" class="btn btn-outline-warning btn-sm m-1 edit-record-btn" data-target="#edit-record-modal" data-toggle="modal">
                <span class="oi oi-pencil"></span>
              </button>
              <button id="delete-record-{{ $loan->id }}" class="btn btn-outline-danger btn-sm m-1 delete-record-btn" data-target="#delete-record-modal" data-toggle="modal">
                <span class="oi oi-trash"></span>
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @endif
  </div>
</div>