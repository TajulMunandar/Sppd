<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

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
            'email' => 'dapurnya_pu@sent.com',
            'pass' => 'never-die',
            'password' => bcrypt('never-die'),
        ]);

        $role = Role::find(1);

        $user->assignRole($role);
    }
}
