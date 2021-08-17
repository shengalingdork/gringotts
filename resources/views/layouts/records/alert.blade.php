@if ($overallBalance < 0)
<div class="alert alert-danger">
  <h4 class="alert-heading">Hey, balance it!</h4>
  <p class="mb-0">You already have a negative overall balance. Please settle your loan.</p>
</div>
@endif
