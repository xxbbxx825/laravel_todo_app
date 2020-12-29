<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SubTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('sub_tasks')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $subTasks1 = ['ページネーションを追加','リマインド機能を修正','登録ページ作成'];
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
