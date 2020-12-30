<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      DB::table('tasks')->truncate();
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');

      $tasks1 = ['Laravelでtodo管理アプリを作る','衣替えをする','期日前投票に行く'];
      foreach ($tasks1 as $task) {
        DB::table('tasks')->insert([
          'title' => $task,
          'status' => 0,
          'user_id' => 51,
          'due' => new Carbon('tomorrow'),
          'created_at' => new \DateTime(),
          'updated_at' => new \DateTime()
        ]);
      }
      $tasks2 = ['VueでSPAアプリを作る','帰省の準備する','プレゼント買いに行く'];
      foreach ($tasks2 as $task) {
        DB::table('tasks')->insert([
          'title' => $task,
          'status' => 0,
          'user_id' => 52,
          'due' => new Carbon('2020-12-20'),
          'created_at' => new \DateTime(),
          'updated_at' => new \DateTime()
        ]);
      }
    }
}
