<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon as Carbon;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;

class InitUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $carbon = new Carbon();

        DB::table('roles')->insert([
            'name' => 'admin',
            'display_name' => 'admin_display',
            'created_at' => $carbon::now(),
            'updated_at' => $carbon::now()
        ]);


        DB::table('users')->insert([
            'role_id' => 1,
            'name' => 'kevinho',
            'email' => 'kevinho@ifalo.com',
            'avatar' => 'users/default.png',
            'password' => Hash::make('ifalo'),
            'created_at' => $carbon::now(),
            'updated_at' => $carbon::now()
        ]);
    }
}
