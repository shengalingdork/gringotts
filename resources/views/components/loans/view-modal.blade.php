<x-modal id="view-loan{{ $loan->id }}-modal" action="" method="" has-body="1" has-footer="0">
  <x-slot name="title">{{ $loan->item }} Payments</x-slot>
  <x-slot name="hiddenInputs"></x-slot>
  <x-slot name="buttonAction"></x-slot>

  @if (count($loan->relations) === 0)
  <div class="alert alert-light">
    There are no payments for this loan yet.
  </div>
  @else
  <div class="table-responsive">
    <table class="table table-hover table-striped">
      <thead>
        <tr class="table-active d-flex table-sm text-center">
          <th scope="col" class="col">Date</th>
          <th scope="col" class="col">Amount</th>
          <th scope="col" class="col">Running Balance</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
      @foreach ($loan->relations as $payment)
      <tr class="d-flex text-center">
        <td class="col">{{ $payment->recorded_at }}</td>
        <td class="col">&#8369;{{ $payment->cost }} </td>
        <td class="col">&#8369;{{ $payment->balance }} </td>
      </tr>
      @endforeach
      <tr class="d-flex text-center">
        <th scope="col" class="col">Total</td>
        <td class="col">&#8369;{{ $loan->paid }}</td>
        <td class="col"></td>
      </tr>
    </table>
  </div>
  @endif
</x-modal>