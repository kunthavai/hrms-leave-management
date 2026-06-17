<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            $adminRole = Role::where('slug', 'admin')->first();
            $userRole  = Role::where('slug', 'employee')->first();

            if (!$adminRole || !$userRole) {
                $this->command->error('Roles not found!');
                return;
            }

            // Example: assign first user as admin
            $adminUser = User::where('email', 'admin@example.com')->first();

            if ($adminUser) {
                $adminUser->roles()->sync([$adminRole->id,$userRole->id]);
            }

            //Assign all other users as normal users
            $users = User::where('email', '!=', 'admin@example.com')->get();

            foreach ($users as $user) {
                $user->roles()->syncWithoutDetaching([$userRole->id]);
            }

            $this->command->info('Role-User mapping completed successfully!');

        } catch (\Exception $e) {
            $this->command->error('Error: ' . $e->getMessage());
        }
    }
}
