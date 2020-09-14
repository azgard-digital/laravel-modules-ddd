<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('123456'),
        ]);

        DB::table('wallets')->insert([
            'address' => '5a4221f08980d4ec6ba0c437734473d7',
            'user_id' => 1,
            'balance' => 100000000,
        ]);

        DB::table('transactions')->insert([
            'created_at' => '2020-09-14 07:39:33',
            'updated_at' => '2020-09-14 07:39:33',
            'user_id' => 1,
            'wallet_id' => 1,
            'status' => 1,
            'amount' => 100000,
            'fee' => 0,
        ]);
    }
}
