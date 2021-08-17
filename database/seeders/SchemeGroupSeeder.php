<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchemeGroup;
use Carbon\Carbon;

class SchemeGroupSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $d = Carbon::now();
    SchemeGroup::insert([
      ['name' => 'Funds', 'icon_name' => 'donate', 'created_at' => $d, 'updated_at' => $d],
      ['name' => 'Monthly Bills', 'icon_name' => 'file-invoice', 'created_at' => $d, 'updated_at' => $d],
      ['name' => 'Purchases', 'icon_name' => 'store', 'created_at' => $d, 'updated_at' => $d]
    ]);
  }
}
