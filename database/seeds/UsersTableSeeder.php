<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
   
    public function run()
    {
        User::truncate();

        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();
        $guestRole = Role::where('name', 'guest')->first();
        $managerRole = Role::where('name', 'manager')->first();
        $supervisorRole = Role::where('name', 'supervisor')->first();

        $admin = User::create([
            'username' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);

        $user = User::create([
            'username' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('user')
        ]);

        $guest = User::create([
            'username' => 'Guest',
            'email' => 'guest@guest.com',
            'password' => bcrypt('guest')
        ]);

        $manager = User::create([
            'username' => 'Manager',
            'email' => 'manager@manager.com',
            'password' => bcrypt('manager')
        ]);

        $supervisor = User::create([
            'username' => 'Supervisor',
            'email' => 'supervisor@supervisor.com',
            'password' => bcrypt('supervisor')
        ]);

        $admin->roles()->attach($adminRole);
        $user->roles()->attach($userRole);
        $guest->roles()->attach($guestRole);
        $manager->roles()->attach($managerRole);
        $supervisor->roles()->attach($supervisorRole);
    }
}
