<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Models\Employee;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('post')) {
            $employeeId = $this->input('id');
            $employee = Employee::find($employeeId);
            return [
                    'employee_code' => [
                    'required',
                        'string',
                        'max:50',
                        Rule::unique('employees', 'employee_code')->ignore($employeeId),
                        'regex:/^[A-Za-z0-9]+$/'
                    ],

                    'name' => 'required|string|max:255|regex:/^[A-Za-z\s\.]+$/',

                    'email' => [
                        'required',
                        'email',
                        'max:255',
                        Rule::unique('users', 'email')->ignore($employee?->user_id),
                    ],

                    'phone' => [
                        'required',
                        'digits:10',
                        Rule::unique('employees', 'phone')->ignore($employeeId),
                    ],

                    'department_id' => 'required|exists:departments,id',
                    'joining_date' => 'required|date',
            ];
        }

        return [];
    }
    public function messages(): array
    {
        return [
            'employee_code.required' => 'Employee Code is required.',
            'employee_code.unique'   => 'Employee Code already exists.',
            'employee_code.regex' => 'Employee Code can contain only letters and numbers.',
            'name.required'          => 'Name is required.',
            'name.regex' => 'Name can contain only letters, spaces and dots.',
            'email.required'         => 'Email is required.',
            'email.email'            => 'Please enter a valid email address.',
            'email.unique'           => 'Email already exists.',

            'phone.required'         => 'Phone number is required.',
            'phone.digits'           => 'Phone number must be 10 digits.',

            'department_id.required' => 'Department is required.',
            'department_id.exists'   => 'Selected department is invalid.',

            'joining_date.required'  => 'Joining Date is required.',
            'joining_date.date'      => 'Joining Date must be a valid date.',
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
                
            ], 422)
        );
    }
}
