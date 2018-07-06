<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        date_default_timezone_set("Asia/Shanghai");

        DB::table('users')->delete();

        \App\User::create([
            'name' => '使用者',
            'email' => 'root@example.com',
            'password' => '$2y$10$Ne.bcoZF9U5Dvvg.ZsexM.YOcdcFc8jPn1Tn6Y0.bumw8vxGb08/.',
            'photo' => '11.jpg',
            'introduction' => '',
            'remember_token' => 'T0xK0emVByaJKYBuLfBOMJerBQMmmEp1y2i0TGXr7MrnCuD2ZajqQCUzfUxu',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ]);
    }
}
