<x-modal id="delete-category-modal" action="" method="POST" has-body="0" has-footer="1">
  <x-slot name="title"></x-slot>
  <x-slot name="hiddenInputs">
    <input name="_method" type="hidden" value="DELETE">
  </x-slot>
  <x-slot name="buttonAction">
    Yes, delete category
  </x-slot>
</x-modal>