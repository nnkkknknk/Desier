<?php

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('admin_users')->insert([
            'name' => 'nk',
            'email' => 'nkadmin@example.com',
            'password' => Hash::make('nkadmin'),
            'admin_level' => 1,
        ]);
    }
}
