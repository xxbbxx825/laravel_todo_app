<?php

namespace Database\Seeders;

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
      DB::table('tasks')->truncate();

      $tasks = ['Laravelでtodo管理アプリを作る','衣替えをする','期日前投票に行く'];
      foreach ($tasks as $task) {
        DB::table('tasks')->insert([
          'title' => $task,
          'status' => 0,
          'user_id' => 1,
          'created_at' => new \DateTime(),
          'updated_at' => new \DateTime()
        ]);
        }
        // DB::table('tasks')->insert([
        //   'title' => 'id51のタスク',
        //   'status' => 0,
        //   'user_id' => 51,
        //   'created_at' => new \DateTime(),
        //   'updated_at' => new \DateTime()
        // ]);
    }
}
