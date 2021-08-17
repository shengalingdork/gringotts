<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecordRelation extends Model
{
  protected $table = 'record_relations';

  protected $fillable = [
    'record_id',
    'related_record_id'
  ];

  public function record()
  {
    return $this->belongsTo(Record::class);
  }

  public function relatedRecord()
  {
    return $this->hasOne(Record::class, 'id', 'related_record_id');
  }
}
