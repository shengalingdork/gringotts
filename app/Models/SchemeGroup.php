<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchemeGroup extends Model
{
  protected $table = 'scheme_groups';

  protected $fillable = [
    'name',
    'icon_name'
  ];
}
