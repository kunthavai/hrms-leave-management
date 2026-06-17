<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\Repositories\EmployeeRepository;
use App\Models\Department;
use App\Models\Employee;
class EmployeeController extends Controller
{
    public function __construct(EmployeeRepository $employeeRepository) {
        $this->employeeRepository = $employeeRepository;
    }
    public function index()
    {
        $employees = $this->employeeRepository->getPaginatedEmployees();

        return view('employees.index', compact('employees'));
    }
    public function  createOrUpdate(EmployeeRequest $request){             
        if ($request->isMethod('post')) {
            $id = $request->id ?? null;          
             $this->employeeRepository->saveEmployee($request->validated(),$id);   
            
            
              return response()->json([
                    'redirect_url' => route('employees', [
                        'success' => $id ? 'Employee updated successfully!' : 'Employee added successfully!'
                    ]),
                    'message' => $id ? 'Employee updated successfully!' : 'Employee added successfully!'
                ]);
        }
        $departments = Department::where('status',1)->get();
        return view('employees.add',compact('departments'));
    }
    public function getEmployee(Employee $employee,Request $request){        
        $action = $request->input('action');
        $departments = Department::where('status',1)->get();
        if ($action === 'delete') {
            return view('employees.delete', compact('employee'));
        }

        return view('employees.edit', compact('employee','departments'));
    } 
    public function delete($id)
    {      
        $this->employeeRepository->deleteEmployee($id);
        return redirect()->back()->with('success', 'Deleted successfully');

    }
}
