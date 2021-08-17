<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="{{ url('/') }}">
    <img class="mx-2" src="{{ asset('images/gringotts.svg') }}" width="50" height="50" alt="" loading="lazy">
    {{ config('app.name', 'Gringotts') }}
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-contents"
    aria-controls="navbar-contents" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div id="navbar-contents" class="collapse navbar-collapse justify-content-end">
    <ul class="navbar-nav" style="font-size:14px">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('records') }}">Records</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('schemes') }}">Schemes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('loans') }}">Loans</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('lookups') }}">Look-ups</a>
      </li>
    </ul>
  </div>
</nav>
