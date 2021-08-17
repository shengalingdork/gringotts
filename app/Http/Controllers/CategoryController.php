<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  protected $__category;

  public function __construct()
  {
    $this->__category = app(CategoryRepository::class);
  }

  public function index()
  {
    return $this->__category->all();
  }

  public function show($id)
  {
    $category = $this->__category->find($id);
    return $category->toJson();
  }

  public function store(Request $request)
  {
    $params = [
      'name' => $request->name,
      'kind' => $request->kind,
      'icon_name' => $request->icon_name
    ];

    $category = $this->__category->create($params);
    return $category->toJson();
  }

  public function update(Request $request, $id)
  {
    $category = $this->__category->save($request, $id);
    return $category->toJson();
  }

  public function destroy($id)
  {
    $this->__category->destroy($id);
    return redirect('lookups');
  }
}
