<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->delete();

        for ($i = 1; $i <= 10; $i++) {
            for ($j = 1; $j <= 2; $j++){
                \App\Comment::create([
                    'articles_id' => $i,
                    'content' => '留言'. $j,
                    'name' => '留言人'. $j
                ]);
            }
        }
    }
}
