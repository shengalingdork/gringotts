<?php

namespace App\View\Components\loans;

use Illuminate\View\Component;

class ViewModal extends Component
{
  public $loan;

  public function __construct($loan)
  {
    $this->loan = $loan;
  }

  public function render()
  {
    return view('components.loans.view-modal');
  }
}
