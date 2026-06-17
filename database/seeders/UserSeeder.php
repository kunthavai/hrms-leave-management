<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employee;
use App\Models\LeaveBalance;
use App\Models\LeaveType;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
             try {
                $collectionName = 'users';
                $recordsExist = false;
                try {
                    $count = User::count();
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

            $users = [
                    ['email' => 'admin@example.com','password' => Hash::make('1234'),'employee_code' => 'EMP001','name' => 'Kunthavai','phone' => '9876543210','department_id' => 1,'joining_date' => now(),'status' => 1,'role_id'=>1,'paid_leave_balance'=>12,'sick_leave_balance'=>6],
                    ['email' => 'user@example.com','password' => Hash::make('1234'),'employee_code' => 'EMP002','name' => 'bhabha','phone' => '9876543211','department_id' => 1,'joining_date' => now(),'status' => 1,'role_id'=>2,'paid_leave_balance'=>12,'sick_leave_balance'=>6],
                    ['name' => 'TestUser','email' => 'testuser@example.com','password' => Hash::make('1234'),'employee_code' => 'EMP003','phone' => '9876543212','department_id' => 2,'joining_date' => now(),'status' => 1,'role_id'=>2,'paid_leave_balance'=>12,'sick_leave_balance'=>6],
                    
                ];
            $leave_types = LeaveType::where('status',1)->get();
            
                 $createdCount = 0;

                foreach ($users as $userData) {
                    try {
                       $user= User::create([
                            'name' => $userData['name'],
                            'email' =>$userData['email'],
                            'password' => $userData['password'],
                            'role_id' => $userData['role_id'],
                        ]);
                        Employee::create([
                            'user_id' => $user->id,
                            'employee_code' => $userData['employee_code'],
                            'name' =>  $userData['name'],
                            'email' =>$userData['email'],
                            'phone' =>  $userData['phone'],
                            'department_id' => $userData['department_id'],
                            'joining_date' =>  $userData['joining_date'],
                            'status' =>  $userData['status']
                        ]);
                         foreach($leave_types as $leave_type){
                            LeaveBalance::create([
                                'user_id' => $user->id,
                                'leave_type_id' => $leave_type->id,
                                'allocated_days' => $leave_type->default_days,
                                'availed_days' => 0,
                                'balance_days' => $leave_type->default_days,
                                'status'=>1
                            ]);
                    }
                        $this->command->info('Created: ' . $userData['name']);
                        $createdCount++;
                    } catch (\Exception $e) {
                        $this->command->error('Error processing ' . $userData['name'] . ': ' . $e->getMessage());
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
