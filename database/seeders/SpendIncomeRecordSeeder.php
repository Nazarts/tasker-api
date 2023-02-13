<?php

namespace Database\Seeders;

use App\Models\SpendIncomeRecord;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpendIncomeRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SpendIncomerecord::factory()->count(20)->create();
    }
}
