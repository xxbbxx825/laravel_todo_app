<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
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
        User::factory()
            ->times(50)
            ->create();
        // DB::table('users')->insert([
        //     'name' => 'foo',
        //     'email' => 'foo@example.com',
        //     'email_verified_at' => now(),
        //     'password' => '11111111', // password
        //     'remember_token' => Str::random(10),
        //     'created_at' => new \DateTime(),
        //     'updated_at' => new \DateTime()
        // ]);
    }
}
