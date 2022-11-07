<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'username' => 'admin',
                    'password' => bcrypt('admin'),
                    'role' => 'r1',
                    'isActive' => true,
                    'fullName' => 'Hồ Minh Hãi',
                    'age' => 21,
                    'phone' => '04322222222',
                    'avatar' => '',
                    'major' => 'CNTT'
                ]
            ]
        );
    }
}
