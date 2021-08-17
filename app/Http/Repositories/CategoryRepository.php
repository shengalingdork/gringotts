<?php

namespace App\Http\Repositories;

use App\Models\Category;

class CategoryRepository
{
  public function all()
  {
    try {
      return Category::all();
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

  public function find($id)
  {
    try {
      return Category::findOrFail($id);
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

  public function create($params)
  {
    try {
      return Category::create($params);
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

  public function save($params, $id)
  {
    try {
      $category = Category::findOrFail($id);

      $category->name = $params->name;
      $category->kind = $params->kind;
      $category->icon_name = $params->icon_name;
  
      $category->save();
  
      return $category;
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

  public function destroy($id)
  {
    try {
      Category::destroy($id);
      return;
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }
}
