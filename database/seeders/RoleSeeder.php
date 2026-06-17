<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Str;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
                $collectionName = 'roles';
                $recordsExist = false;
                try {
                    $count = Role::count();
                    if ($count > 0) {
                        $recordsExist = true;
                    }
                } catch (\Exception $e) {
                    $recordsExist = false;
                }

                if ($recordsExist) {
                    $this->info("Records already exist in '{$collectionName}' collection.");
                    $this->command->info('Skipping migration...');
                    return;
                    
                }
                $this->command->info("Records do not exist in '{$collectionName}'. Creating records...");

            $roles = [
                    ['name' => 'Admin'],                    
                    ['name' => 'Employee'],
                    
                ];
                 $createdCount = 0;

                foreach ($roles as $role) {
                    try {
                        Role::create([
                            'name' => $role['name'],
                            'slug' =>Str::slug($role['name']),
                            'status' => 1,
                        ]);
                        $this->command->info('Created: ' . $role['name']);
                        $createdCount++;
                    } catch (\Exception $e) {
                        $this->command->error('Error processing ' . $role['name'] . ': ' . $e->getMessage());
                    }
                }

                $this->command->info("User setup completed! Created: {$createdCount} records.");
                return;
                
            } catch (\Exception $e) {
                $this->command->error('Error: ' . $e->getMessage());
                return;
            }
    
    }
}
