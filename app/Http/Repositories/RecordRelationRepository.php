<?php

namespace App\Http\Repositories;

use App\Models\RecordRelation;

class RecordRelationRepository
{
  public function create($params)
  {
    try {
      return RecordRelation::create($params);
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

  public function saveByRelatedRecordId($params, $id)
  {
    try {
      $record = RecordRelation::where('related_record_id', $id)->firstOrFail();
      $record->record_id = $params['record_id'];
      $record->save();
      return $record;
    } catch (\Exception $e) {
      return false;
    }
  }

  public function destroyByRelatedRecordId($id)
  {
    try {
      RecordRelation::where('related_record_id', $id)->delete();
      return;
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }
}
