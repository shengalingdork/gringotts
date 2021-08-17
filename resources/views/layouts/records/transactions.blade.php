<div class="card my-4">
  <div class="card-header h3">
    <span>Transactions</span>
  </div>
  <div class="card-body">
    @if (count($transactions) === 0)
    <div class="alert alert-light">
      There are no transactions on this month.
    </div>
    @else
    <div class="table-responsive">
      <table class="table table-hover table-striped">
        <thead>
          <tr class="table-active d-flex table-sm text-center">
            <th scope="col" class="col">Category (Scheme)</th>
            <th scope="col" class="col-6">Name</th>
            <th scope="col" class="col-2">Amount</th>
            <th scope="col" class="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($transactions as $transaction)
          <tr id="record-{{ $transaction->id }}" class="d-flex">
            <td class="col text-center h3">
              <span class="badge badge-pill badge-{{ $transaction->category->kind === 'source' ? 'success' : 'danger' }} m-1" title="{{ $transaction->category->name }}">
                <i class="fas fa-{{ $transaction->category->icon_name }}"></i>
              </span>
              @if ($transaction->scheme_id !== null)
              <button class="btn btn-info btn-sm m-1" title="{{ $transaction->scheme->scheme_group->name }}" onclick="location.href='/schemes/{{ $transaction->scheme_id }}'">
                <i class="fas fa-{{ $transaction->scheme->scheme_group->icon_name }}"></i>
              </button>
              @endif
            </td>
            <td class="col-6 record-name">{{ $transaction->scheme_id ? $transaction->scheme->item : $transaction->item }}</td>
            <td class="col-2 text-center">&#8369;{{ $transaction->cost }}</td>
            <td class="col text-center">
              <button id="edit-record-{{ $transaction->id }}" class="btn btn-outline-warning btn-sm m-1 edit-record-btn" data-target="#edit-record-modal" data-toggle="modal">
                <span class="oi oi-pencil"></span>
              </button>
              <button id="delete-record-{{ $transaction->id }}" class="btn btn-outline-danger btn-sm m-1 delete-record-btn" data-target="#delete-record-modal" data-toggle="modal">
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