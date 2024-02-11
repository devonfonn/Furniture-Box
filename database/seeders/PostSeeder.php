<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'title' => '家具1',
            'image' => '写真',
            'caption' => '家具やインテリアの説明をする。',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ]);
            
    }
}
