<?php

use Illuminate\Database\Seeder;

class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('article_categories')->delete();

        for ($i = 1; $i <= 10; $i++) {
            \App\ArticleCategory::create([
                'articles_id' => $i,
                'categories_id' => $i
            ]);
        }

        for ($i = 1; $i <= 10; $i++) {
            \App\ArticleCategory::create([
                'articles_id' => $i,
                'categories_id' => (11 - $i)
            ]);
        }
    }
}
