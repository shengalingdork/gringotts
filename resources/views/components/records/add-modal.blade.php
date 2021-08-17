<x-modal id="add-record-modal" action="/records" method="POST" has-body="1" has-footer="1">
  <x-slot name="title">Add a Record</x-slot>
  <x-slot name="hiddenInputs"></x-slot>
  <x-slot name="buttonAction">
    Add Record
  </x-slot>

  <div class="form-row row">
    <div class="form-group col">
      <label class="col-form-label">Date:</label>
      <input type="date" class="form-control recorded-at" name="recorded_at" required>
    </div>
  </div>
  <div class="form-row row">
    <div class="form-group col">
      <label class="col-form-label">Scheme:</label>
      <select class="form-control form-select schemes" name="scheme_id" required></select>
    </div>
  </div>
  <div class="form-row row">
    <div class="form-group col">
      <label class="col-form-label">Category:</label>
      <select class="form-control form-select categories" name="category_id" required></select>
    </div>
  </div>
  <div class="form-row row" style="display:none">
    <div class="form-group col">
      <label class="col-form-label">Loan (Source):</label>
      <select class="form-control form-select loans" name="loan_id"></select>
    </div>
  </div>
  <div class="form-row row">
    <div class="form-group col">
      <label class="col-form-label">Name:</label>
      <input type="text" class="form-control item" name="item" required>
    </div>
  </div>
  <div class="form-row row">
    <div class="form-group col">
      <label class="col-form-label">Cost:</label>
      <div class="input-group">
        <span class="input-group-text">&#8369;</span>
        <input type="number" min="1" step="0.01" class="form-control cost" name="cost" placeholder="0.00" required>
      </div>
    </div>
  </div>
</x-modal>