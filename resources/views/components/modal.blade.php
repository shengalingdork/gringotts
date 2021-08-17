<div id="{{ $id }}" class="modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ $action }}" method="{{ $method }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {{ $hiddenInputs }}
        <div class="modal-header">
          <h4 class="modal-title">{{ $title }}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @if (boolval($hasBody))
        <div class="modal-body">
          {{ $slot }}
        </div>
        @endif
        @if (boolval($hasFooter))
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Cancel
          </button>
          <button type="submit" class="btn btn-primary">
            {{ $buttonAction }}
          </button>
        </div>
        @endif
      </form>
    </div>
  </div>
</div>