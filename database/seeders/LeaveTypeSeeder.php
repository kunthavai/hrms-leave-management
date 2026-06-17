<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LeaveType;
use Illuminate\Support\Str;
class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
                $collectionName = 'leave_types';
                $recordsExist = false;
                try {
                    $count = LeaveType::count();
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

            $leave_types = [
                    ['name' => 'Casual Leave','code'=>'CL','default_days'=>12,'status'=>1],                    
                    ['name' => 'Sick Leave','code'=>'SL','default_days'=>6,'status'=>1], 
                    ['name' => 'Paid Leave','code'=>'PAL','default_days'=>12,'status'=>1], 
                    
                ];
                 $createdCount = 0;

                foreach ($leave_types as $leave_type) {
                    try {
                        LeaveType::create([
                            'name' => $leave_type['name'],
                            'code' =>$leave_type['code'],
                            'status' => 1,
                            'default_days'=>$leave_type['default_days']
                        ]);
                        $this->command->info('Created: ' . $leave_type['name']);
                        $createdCount++;
                    } catch (\Exception $e) {
                        $this->command->error('Error processing ' . $leave_type['name'] . ': ' . $e->getMessage());
                    }
                }

                $this->command->info("Leave Type setup completed! Created: {$createdCount} records.");
                return;
                
            } catch (\Exception $e) {
                $this->command->error('Error: ' . $e->getMessage());
                return;
            }
    
    
    }
}
