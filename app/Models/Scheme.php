<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scheme extends Model
{
  protected $table = 'schemes';

  protected $fillable = [
    'scheme_group_id',
    'category_id',
    'item',
    'cost',
    'balance',
    'start_at',
    'end_at'
  ];

  public function schemeGroup()
  {
    return $this->belongsTo(SchemeGroup::class);
  }

  public function category()
  {
    return $this->belongsTo(Category::class);
  }
}
