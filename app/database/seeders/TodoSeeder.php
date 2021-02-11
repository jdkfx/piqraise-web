<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DateTime;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('todos')->insert([
            'done_flag' => false,
            'content' => Str::random(25),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('todos')->insert([
            'done_flag' => true,
            'content' => Str::random(25),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('todos')->insert([
            'done_flag' => false,
            'content' => Str::random(25),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
