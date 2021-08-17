<?php

namespace App\Http\Controllers;

class LookupsController extends Controller
{
  protected $_category;
  protected $_schemeGroup;

  public function __construct()
  {
    $this->_category = app(CategoryController::class);
    $this->_schemeGroup = app(SchemeGroupController::class);
  }

  public function index()
  {
    $categories = $this->_category->index();
    $schemeGroups = $this->_schemeGroup->index();

    return view('layouts.pages.lookups')
      ->with('categories', $categories)
      ->with('schemeGroups', $schemeGroups);
  }
}
