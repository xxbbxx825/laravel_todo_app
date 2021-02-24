<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SamplesSeeder extends Seeder
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

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('tasks')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $tasks1 = ['Laravelでtodo管理アプリを作る', '衣替えをする', '期日前投票に行く'];
        foreach ($tasks1 as $task) {
            DB::table('tasks')->insert([
                'title' => $task,
                'status' => 0,
                'user_id' => 1,
                'due' => new Carbon('tomorrow'),
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime()
            ]);
        }
        $tasks2 = ['VueでSPAアプリを作る', '帰省の準備する', 'プレゼント買いに行く'];
        foreach ($tasks2 as $task) {
            DB::table('tasks')->insert([
                'title' => $task,
                'status' => 0,
                'user_id' => 2,
                'due' => new Carbon('2020-12-20'),
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime()
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('sub_tasks')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $subTasks1 = ['ページネーションを追加', 'リマインド機能を修正', '登録ページ作成'];
        foreach ($subTasks1 as $t) {
            DB::table('sub_tasks')->insert([
                'title' => $t,
                'status' => 0,
                'task_id' => 1,
                'due' => new Carbon('tomorrow'),
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime()
            ]);
        }
    }
}
