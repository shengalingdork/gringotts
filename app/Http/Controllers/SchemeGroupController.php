<?php

namespace App\Http\Controllers;

use App\Http\Repositories\SchemeGroupRepository;
use Illuminate\Http\Request;

class SchemeGroupController extends Controller
{
  protected $_schemeGroup;

  public function __construct()
  {
    $this->_schemeGroup = app(SchemeGroupRepository::class);
  }

  public function index()
  {
    return $this->_schemeGroup->all();
  }

  public function show($id)
  {
    $schemeGroup = $this->_schemeGroup->find($id);
    return $schemeGroup->toJson();
  }

  public function store(Request $request)
  {
    $params = [
      'name' => $request->name,
      'icon_name' => $request->icon_name
    ];

    $schemeGroup = $this->_schemeGroup->create($params);
    return $schemeGroup->toJson();
  }

  public function update(Request $request, $id)
  {
    $schemeGroup = $this->_schemeGroup->save($request, $id);
    return $schemeGroup->toJson();
  }

  public function destroy($id)
  {
    $this->_schemeGroup->destroy($id);
    return redirect('lookups');
  }
}
