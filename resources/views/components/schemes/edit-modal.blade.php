<x-modal id="edit-scheme-modal" action="/schemes" method="POST" has-body="1" has-footer="1">
  <x-slot name="title"></x-slot>
  <x-slot name="hiddenInputs">
    <input name="_method" type="hidden" value="PUT">
    <input id="scheme-group-id" type="hidden" name="scheme_group_id">
  </x-slot>
  <x-slot name="buttonAction">
    Edit Scheme
  </x-slot>

  <div class="form-row row">
    <div class="form-group col">
      <label class="col-form-label">Name:</label>
      <input id="name" type="text" class="form-control" name="item" required>
    </div>
  </div>
  <div class="form-row row">
    <div class="form-group col">
      <label class="col-form-label">Cost:</label>
      <div class="input-group">
        <span class="input-group-text">&#8369;</span>
        <input id="cost" type="number" min="1" step="0.01" class="form-control" name="cost" placeholder="0.00" required>
      </div>
    </div>
  </div>
  <div class="form-row row">
    <div class="form-group col">
      <label class="col-form-label">Category:</label>
      <select class="form-control form-select categories" name="category_id" required></select>
    </div>
  </div>
  <div class="form-row row">
    <div class="form-group col">
      <label class="col-form-label">Start Date:</label>
      <input id="start-at" type="date" class="form-control duration" name="start_at" required>
    </div>
    <div class="form-group col">
      <label class="col-form-label">End Date:</label>
      <input id="end-at" type="date" class="form-control duration" name="end_at" required>
    </div>
    <div class="form-group col-2">
      <label class="col-form-label">Month(s):</label>
      <input id="month-duration" type="text" disabled="" class="form-control" name="months" placeholder="0">
    </div>
  </div>
</x-modal>