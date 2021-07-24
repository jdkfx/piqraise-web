<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
            'user_id' => 1,
            'done_flag' => false,
            'public_flag' => false,
            'content' => "コードを書く",
            'target_date' => Carbon::today(),
            'created_at' => new DateTime('2021-07-01 23:01:05'),
            'updated_at' => new DateTime('2021-07-02 23:01:05'),
        ]);

        DB::table('todos')->insert([
            'user_id' => 1,
            'done_flag' => true,
            'public_flag' => true,
            'content' => "コードを修正する",
            'target_date' => Carbon::today(),
            'created_at' => new DateTime('2021-07-03 23:01:05'),
            'updated_at' => new DateTime('2021-07-04 23:01:05'),
        ]);

        DB::table('todos')->insert([
            'user_id' => 1,
            'done_flag' => false,
            'public_flag' => true,
            'content' => "コードを修正する",
            'target_date' => Carbon::today(),
            'created_at' => new DateTime('2021-07-05 23:01:05'),
            'updated_at' => new DateTime('2021-07-06 23:01:05'),
        ]);

        DB::table('todos')->insert([
            'user_id' => 1,
            'done_flag' => false,
            'public_flag' => false,
            'content' => "コードを更新する",
            'target_date' => Carbon::tomorrow(),
            'created_at' => new DateTime('2021-07-01 23:01:05'),
            'updated_at' => new DateTime('2021-07-02 23:01:05'),
        ]);

        DB::table('todos')->insert([
            'user_id' => 1,
            'done_flag' => true,
            'public_flag' => true,
            'content' => "コードを更新する",
            'target_date' => Carbon::tomorrow(),
            'created_at' => new DateTime('2021-07-03 23:01:05'),
            'updated_at' => new DateTime('2021-07-04 23:01:05'),
        ]);

        DB::table('todos')->insert([
            'user_id' => 1,
            'done_flag' => false,
            'public_flag' => true,
            'content' => "コードを更新する",
            'target_date' => Carbon::tomorrow(),
            'created_at' => new DateTime('2021-07-05 23:01:05'),
            'updated_at' => new DateTime('2021-07-06 23:01:05'),
        ]);

        DB::table('todos')->insert([
            'user_id' => 1,
            'done_flag' => false,
            'public_flag' => false,
            'content' => "コードを削除する",
            'target_date' => Carbon::yesterday(),
            'created_at' => new DateTime('2021-07-01 23:01:05'),
            'updated_at' => new DateTime('2021-07-02 23:01:05'),
        ]);

        DB::table('todos')->insert([
            'user_id' => 1,
            'done_flag' => true,
            'public_flag' => true,
            'content' => "コードを削除する",
            'target_date' => Carbon::yesterday(),
            'created_at' => new DateTime('2021-07-03 23:01:05'),
            'updated_at' => new DateTime('2021-07-04 23:01:05'),
        ]);

        DB::table('todos')->insert([
            'user_id' => 1,
            'done_flag' => false,
            'public_flag' => true,
            'content' => "コードを削除する",
            'target_date' => Carbon::today(),
            'created_at' => new DateTime('2021-07-05 23:01:05'),
            'updated_at' => new DateTime('2021-07-06 23:01:05'),
        ]);

        DB::table('todos')->insert([
            'user_id' => 1,
            'done_flag' => false,
            'public_flag' => true,
            'content' => "コードをプッシュする",
            'target_date' => Carbon::today(),
            'created_at' => new DateTime('2021-07-05 23:01:05'),
            'updated_at' => new DateTime('2021-07-06 23:01:05'),
        ]);

        DB::table('todos')->insert([
            'user_id' => 1,
            'done_flag' => false,
            'public_flag' => true,
            'content' => "コードをプッシュする",
            'target_date' => Carbon::today(),
            'created_at' => new DateTime('2021-07-05 23:01:05'),
            'updated_at' => new DateTime('2021-07-06 23:01:05'),
        ]);

        DB::table('todos')->insert([
            'user_id' => 1,
            'done_flag' => true,
            'public_flag' => true,
            'content' => "コードをプッシュする",
            'target_date' => Carbon::today(),
            'created_at' => new DateTime('2021-07-05 23:01:05'),
            'updated_at' => new DateTime('2021-07-06 23:01:05'),
        ]);

        DB::table('todos')->insert([
            'user_id' => 1,
            'done_flag' => true,
            'public_flag' => true,
            'content' => "コードを書く",
            'target_date' => Carbon::today(),
            'created_at' => new DateTime('2021-07-05 23:01:05'),
            'updated_at' => new DateTime('2021-07-06 23:01:05'),
        ]);
    }
}
