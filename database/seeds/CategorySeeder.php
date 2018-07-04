<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();

        for ($i = 1; $i <= 10; $i++) {
            \App\Category::create([
                'name' => '分類 ' . $i,
                'status' => '1'
            ]);
        }
    }
}
