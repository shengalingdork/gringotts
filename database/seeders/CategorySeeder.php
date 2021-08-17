<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Category::insert([
      ['name' => 'Loan', 'kind' => 'source', 'icon_name' => 'hand-holding-usd', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
      ['name' => 'Loan', 'kind' => 'expenses', 'icon_name' => 'money-bill-wave', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
      ['name' => 'Savings', 'kind' => 'source', 'icon_name' => 'piggy-bank', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
      ['name' => 'Savings', 'kind' => 'expenses', 'icon_name' => 'hand-holding-usd', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
      ['name' => 'Job Salary', 'kind' => 'source', 'icon_name' => 'coins', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
      ['name' => 'Business Profit', 'kind' => 'source', 'icon_name' => 'landmark', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
      ['name' => 'Food', 'kind' => 'expenses', 'icon_name' => 'hamburger', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
      ['name' => 'Transportation', 'kind' => 'expenses', 'icon_name' => 'bus-alt', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
      ['name' => 'Utilities', 'kind' => 'expenses', 'icon_name' => 'faucet', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
      ['name' => 'Groceries/Toiletries', 'kind' => 'expenses', 'icon_name' => 'shopping-cart', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
      ['name' => 'Medical', 'kind' => 'expenses', 'icon_name' => 'prescription-bottle-alt', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
      ['name' => 'Gadget/Appliance', 'kind' => 'expenses', 'icon_name' => 'camera-retro', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
      ['name' => 'Clothing/Shoes', 'kind' => 'expenses', 'icon_name' => 'tshirt', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
      ['name' => 'Gifts', 'kind' => 'expenses', 'icon_name' => 'gifts', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
      ['name' => 'Household Items', 'kind' => 'expenses', 'icon_name' => 'couch', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
      ['name' => 'Entertainment', 'kind' => 'expenses', 'icon_name' => 'headphones', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
      ['name' => 'Travel', 'kind' => 'expenses', 'icon_name' => 'plane-departure', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
      ['name' => 'Duties', 'kind' => 'expenses', 'icon_name' => 'female', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
      ['name' => 'Professional Fees', 'kind' => 'expenses', 'icon_name' => 'briefcase', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
      ['name' => 'Digital', 'kind' => 'expenses', 'icon_name' => 'download', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
      ['name' => 'Miscellaneous', 'kind' => 'expenses', 'icon_name' => 'shapes', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
    ]);
  }
}
