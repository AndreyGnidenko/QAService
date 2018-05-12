<?php

use Illuminate\Database\Seeder;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'login' => 'admin',
            'password' =>  Hash::make('admin')
        ]);

        DB::table('admins')->insert([
            'login' => 'admin2',
            'password' =>  Hash::make('admin2')
        ]);
    }
}
