<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->delete();

        for ($i = 1; $i <= 10; $i++) {
            \App\Tag::create([
                'name' => '標籤 ' . $i,
                'status' => '1'
            ]);
        }
    }
}
