<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Menu;
use App\Models\Role;

class RoleMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::where('slug', 'admin')->first();
        $user  = Role::where('slug', 'employee')->first();

        if (!$admin || !$user) {
            $this->command->error('Roles not found!');
            return;
        }

        //Admin gets ALL menus
        try {
            $allMenuIds = Menu::pluck('id')->toArray();
            $admin->menus()->sync($allMenuIds);
            $this->command->info("Admin Role Menu setup completed!");
            }
        catch (\Exception $e) {
                $this->command->error('Error: ' . $e->getMessage());
                return;
            }

        //User gets limited menus
        try {
        $userMenus = Menu::whereIn('menu_route', [
            'leaves',
            
        ])->pluck('id')->toArray();

        $user->menus()->sync($userMenus);

        $this->command->info('User Role-Menu mapping done!');
        }
        catch (\Exception $e) {
                $this->command->error('Error: ' . $e->getMessage());
                return;
            }
    }
}
