<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
  public $id;
  public $action;
  public $method;
  public $hasBody;
  public $hasFooter;

  public function __construct($id, $action, $method, $hasBody, $hasFooter)
  {
    $this->id = $id;
    $this->action = $action;
    $this->method = $method;
    $this->hasBody = $hasBody;
    $this->hasFooter = $hasFooter;
  }

  public function render()
  {
    return view('components.modal');
  }
}
