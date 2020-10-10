<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('tasks')->truncate();

      $tasks = ['ハンドソープを買う','衣替えをする','シャツをクリーニングに出す'];
      foreach ($tasks as $task) {
        DB::table('tasks')->insert([
          'title' => $task,
          'state' => '未了',
          'created_at' => new \DateTime(),
          'updated_at' => new \DateTime()
        ]);

        }
    }
}
