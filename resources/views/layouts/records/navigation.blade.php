<nav class="navbar navbar-expand-sm navbar-dark bg-dark my-4">
  <span class="navbar-brand">
    PERIOD: {{ $formattedSelectedDate }}
  </span>
  <div class="navbar-collapse justify-content-end">
    <form>
      <div class="form-row">
        <div class="col">
          <select class="custom-select custom-select-sm mr-1 recordDates">
            @foreach ($recordDates as $date)
            <option value="{{ $date['id'] }}" {{ $selectedDate === $date['MMYYYY'] ? 'selected' : '' }}>{{ $date['MMYYYY'] }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-auto">
          <button type="button" class="btn btn-secondary btn-sm add-record-btn" data-target="#add-record-modal" data-toggle="modal">
            <span class="oi oi-plus"></span>
          </button>
        </div>
      </div>
    </form>
  </div>
</nav>