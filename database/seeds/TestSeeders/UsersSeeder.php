<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create admin and user
        \App\User::insert([
            ['id' => 1, 'name' => 'Admin', 'email' => 'admin@test.test', 'password' => Hash::make('password')],
            ['id' => 2, 'name' => 'User', 'email' => 'user@test.test', 'password' => Hash::make('password')]
        ]);
        // create admin role
        $role = \Spatie\Permission\Models\Role::create(['name' => 'admin', 'guard_name' => 'web']);
        // assign admin role
        \App\User::find(1)->assignRole($role);
    }
}
