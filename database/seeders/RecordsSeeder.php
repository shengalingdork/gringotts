<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Record;
use Carbon\Carbon;

class RecordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $d = Carbon::now();
      Record::insert([
        ['category_id' => 1, 'scheme_id' => null, 'item' => 'Sample Loan', 'cost' => 100, 'recorded_at' => $d, 'created_at' => $d, 'updated_at' => $d],
        ['category_id' => 2, 'scheme_id' => null, 'item' => 'Sample Loan', 'cost' => 150, 'recorded_at' => $d, 'created_at' => $d, 'updated_at' => $d],
        ['category_id' => 3, 'scheme_id' => null, 'item' => 'Sample Savings', 'cost' => 200, 'recorded_at' => $d, 'created_at' => $d, 'updated_at' => $d],
        ['category_id' => null, 'scheme_id' => 1, 'item' => null, 'cost' => 333.33, 'recorded_at' => $d, 'created_at' => $d, 'updated_at' => $d],
        ['category_id' => 5, 'scheme_id' => null, 'item' => 'Sample Job Salary', 'cost' => 1000, 'recorded_at' => $d, 'created_at' => $d, 'updated_at' => $d],
        ['category_id' => 6, 'scheme_id' => null, 'item' => 'Sample Business Profit', 'cost' => 1000, 'recorded_at' => $d, 'created_at' => $d, 'updated_at' => $d],
        ['category_id' => 7, 'scheme_id' => null, 'item' => 'Sample Food', 'cost' => 500, 'recorded_at' => $d, 'created_at' => $d, 'updated_at' => $d]
      ]);
    }
}
