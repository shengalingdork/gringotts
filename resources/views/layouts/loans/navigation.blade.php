<nav class="navbar navbar-expand-sm navbar-dark bg-dark my-4">
  <span class="navbar-brand">
    PERIOD: {{ $selectedDate }}
  </span>
  <div class="navbar-collapse justify-content-end">
    <form>
      <div class="form-row">
        <div class="col">
          <select class="custom-select custom-select-sm mr-1 loanDates">
            @foreach ($loanDates as $date)
            <option value="{{ $date['id'] }}" {{ $selectedDate === $date['year'] ? 'selected' : '' }}>{{ $date['year'] }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </form>
  </div>
</nav>