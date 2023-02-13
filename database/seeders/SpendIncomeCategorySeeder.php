<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpendIncomeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('spend_income_categories')->insert([
            [
                'user_id' => 2,
                'category_name' => "Bakery",
                'record_type_id' => 1
            ],
            [
                'user_id' => 2,
                'category_name' => "Meat",
                'record_type_id' => 1
            ],
            [
                'user_id' => 2,
                'category_name' => "Work",
                'record_type_id' => 2
            ]
        ]);
    }
}
