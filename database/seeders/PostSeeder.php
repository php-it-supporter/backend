<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert(
            [
                [
                    'title' => 'title',
                    'type' => 0,
                    'content' => 'content',
                    'image' => 'image',
                    'author' => 1,
                    'category' => 1,
                ],
                [
                    'title' => 'title2',
                    'type' => 1,
                    'content' => 'content',
                    'image' => 'image',
                    'author' => 1,
                    'category' => 1,
                ],
            ]
        );
    }
}
