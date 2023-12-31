<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Laratrust\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $role = Role::find(1);

        $user->assignRole($role);
    }
}
