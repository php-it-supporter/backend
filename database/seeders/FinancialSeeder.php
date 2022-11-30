<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FinancialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('financials')->insert(
            [
                [
                    'event' => 'IT Festival 2022',
                    'totalPaid' => '200000',
                ],
            ]
        );
    }
}
