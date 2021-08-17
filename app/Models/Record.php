<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
  protected $table = 'records';

  protected $fillable = [
    'category_id',
    'scheme_id',
    'item',
    'cost',
    'recorded_at'
  ];

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function scheme()
  {
    return $this->belongsTo(Scheme::class);
  }

  public function relations()
  {
    return $this->hasMany(RecordRelation::class);
  }

  public function relator()
  {
    return $this->belongsTo(RecordRelation::class, 'id', 'related_record_id');
  }
}
