<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use App\Models\LeaveBalance;
use App\Models\LeaveType;
use Illuminate\Support\Facades\DB;
class EmployeeRepository
{
    public function getPaginatedEmployees()
    {
        return Employee::with([
            'department',
            'user'
        ])->where('status',1)->paginate(10);
    }
    public function saveEmployee(array $data, ?int $employeeId = null)
    {
        return DB::transaction(function () use ($data, $employeeId) {

            if ($employeeId) {

                // UPDATE

                $employee = Employee::findOrFail($employeeId);

                $user = $employee->user;

                $user->update([
                    'name'  => $data['name'],
                    'email' => $data['email'],
                ]);

                $employee->update([
                    'employee_code' => $data['employee_code'],
                    'phone' => $data['phone'],
                    'department_id' => $data['department_id'],
                    'joining_date' => $data['joining_date'],
                    'email' => $data['email'],
                ]);

                return $employee;

            } else {
                $employeeRole = Role::where('slug', 'employee')->first();
                // CREATE
                $roleId=Role::where('slug', 'employee')->value('id');
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt('123456'),
                    //'role_id' => $roleId,
                ]);
                $user->roles()->attach($employeeRole->id);
                $employee = Employee::create([
                    'user_id' => $user->id,
                    'employee_code' => $data['employee_code'],
                    'name' => $data['name'],
                    'phone' => $data['phone'],
                    'email' => $data['email'],
                    'department_id' => $data['department_id'],
                    'joining_date' => $data['joining_date'],
                    'status' => 1,
                ]);

                $leaveTypes = LeaveType::where('status', 1)->get();

                foreach ($leaveTypes as $leaveType) {

                    LeaveBalance::create([
                        'user_id' => $user->id,
                        'leave_type_id' => $leaveType->id,
                        'allocated_days' => $leaveType->default_days,
                        'availed_days' => 0,
                        'balance_days' => $leaveType->default_days,
                    ]);
                }

                return $employee;
            }
        });
    }
    public function deleteEmployee($employeeId){
        $employee = Employee::findOrFail($employeeId);
        //dd($employeeId);
        $employee->update(['status'=>0]);
                $user = $employee->user;
                $user->update([
                    'status'  => 0,
                ]);
    }
}