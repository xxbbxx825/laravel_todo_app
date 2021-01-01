<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('users')->insert([
            'name' => 'foo',
            'email' => 'foo@example.com',
            'password' => Hash::make('11111111'),
        ]);
        DB::table('users')->insert([
            'name' => 'bar',
            'email' => 'bar@example.com',
            'password' => Hash::make('11111111'),
        ]);
        User::factory()
            ->times(5)
            ->create();
    }
}
