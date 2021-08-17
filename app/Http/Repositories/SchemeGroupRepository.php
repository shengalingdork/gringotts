<?php

namespace App\Http\Repositories;

use App\Models\SchemeGroup;

class SchemeGroupRepository
{
  public function all()
  {
    try {
      return SchemeGroup::all();
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

  public function find($id)
  {
    try {
      return SchemeGroup::findOrFail($id);
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

  public function create($params)
  {
    try {
      return SchemeGroup::create($params);
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

  public function save($params, $id)
  {
    try {
      $schemeGroup = SchemeGroup::findOrFail($id);

      $schemeGroup->name = $params->name;
      $schemeGroup->icon_name = $params->icon_name;

      $schemeGroup->save();

      return $schemeGroup;
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

  public function destroy($id)
  {
    try {
      SchemeGroup::destroy($id);
      return;
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }
}
