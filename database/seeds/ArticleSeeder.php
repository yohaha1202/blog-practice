<?php

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->delete();

        for ($i = 1; $i <= 10; $i++) {
            \App\Article::create([
                'title' => '標題 ' . $i,
                'photo' => $i .'.jpg',
                'features' => '特色 ' . $i,
                'short_desc' => '描述 ' . $i,
                'view_num' => '0',
                'comment_num' => '0',
                'like_num' => '0',
                'status' => '1'
            ]);
        }
    }
}
