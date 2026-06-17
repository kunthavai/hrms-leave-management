<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use Illuminate\Support\Str;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
                $collectionName = 'departments';
                $recordsExist = false;
                try {
                    $count = Department::count();
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

            $depts = [
                    ['name' => 'HR'],
                    ['name' => 'Account'],
                    ['name' => 'Admin'],
                    ['name' => 'Data Research'],
                    ['name' => 'GRC'],
                    
                ];
                 $createdCount = 0;

                foreach ($depts as $dept) {
                    try {
                        Department::create([
                            'name' => $dept['name'],
                            'slug' => Str::slug($dept['name']),
                            'status' => 1,
                        ]);
                        $this->command->info('Created: ' . $dept['name']);
                        $createdCount++;
                    } catch (\Exception $e) {
                        $this->command->error('Error processing ' . $dept['name'] . ': ' . $e->getMessage());
                    }
                }

                $this->command->info("Department setup completed! Created: {$createdCount} records.");
                return;
                
            } catch (\Exception $e) {
                $this->command->error('Error: ' . $e->getMessage());
                return;
            }
    
    }
}
