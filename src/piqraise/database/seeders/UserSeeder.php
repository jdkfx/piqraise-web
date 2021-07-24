<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'name',
            'email' => str::random(5) . '@gmail.com',
            'created_at' => new DateTime('2021-07-01 23:01:05'),
            'updated_at' => new DateTime('2021-07-02 23:01:05'),
        ]);
    }
}
