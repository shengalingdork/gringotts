<x-modal id="delete-record-modal" action="" method="POST" has-body="0" has-footer="1">
  <x-slot name="title"></x-slot>
  <x-slot name="hiddenInputs">
    <input name="_method" type="hidden" value="DELETE">
    <input id="balance" type="hidden" name="balance" value="0">
  </x-slot>
  <x-slot name="buttonAction">
    Yes, delete record
  </x-slot>
</x-modal>