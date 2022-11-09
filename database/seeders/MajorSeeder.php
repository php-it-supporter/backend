<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('majors')->insert(
            [
                [
                    'name' => 'Công nghệ thông tin',
                ],
                [
                    'name' => 'Kế toán',
                ],
                [
                    'name' => 'Quản trị nhân lực',
                ],
                [
                    'name' => 'Khoa học máy tính',
                ],
            ]
        );
    }
}
