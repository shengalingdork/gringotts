<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Scheme;
use Carbon\CarbonImmutable;

class SchemesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $d = CarbonImmutable::now();
      Scheme::insert([
        [
          'scheme_group_id' => 1,
          'category_id' => 4,
          'item' => 'Emergency Fund',
          'cost' => 1000,
          'balance' => 666.67,
          'start_at' => $d,
          'end_at' => $d->add(2, 'month'),
          'created_at' => $d,
          'updated_at' => $d
        ],
        [
          'scheme_group_id' => 1,
          'category_id' => 4,
          'item' => 'Travel Fund',
          'cost' => 2000,
          'balance' => 1000,
          'start_at' => $d,
          'end_at' => $d->add(1, 'month'),
          'created_at' => $d,
          'updated_at' => $d
        ]
      ]);
    }
}
