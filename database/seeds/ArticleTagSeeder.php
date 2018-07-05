<?php

use Illuminate\Database\Seeder;

class ArticleTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('article_tags')->delete();

        for ($i = 1; $i <= 10; $i++) {
            \App\ArticleTag::create([
                'article_id' => $i,
                'tag_id' => $i
            ]);
        }
        for ($i = 1; $i <= 10; $i++) {
            \App\ArticleTag::create([
                'article_id' => $i,
                'tag_id' => (11 - $i)
            ]);
        }
    }
}
