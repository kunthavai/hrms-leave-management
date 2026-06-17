<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Models\Leave;
use App\Models\LeaveBalance;
use Carbon\Carbon;
class LeaveRequest extends FormRequest
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
            return [                
                'leave_type_id' => 'required|exists:leave_types,id',
                'from_date' => 'required|date',
                'to_date' => 'required|date|after_or_equal:from_date',
                'reason' => 'required|string|max:1000',
            ];
        }
        return [];
    }
    public function messages(): array
    {
        return [
            
            'leave_type_id.required' => 'Leave type is required.',
            'from_date.required' => 'From date is required.',
            'to_date.required' => 'To date is required.',
            'to_date.after_or_equal' =>
                'To date must be greater than or equal to From date.',
            'reason.required' => 'Reason is required.',
        ];
    }
    

    public function withValidator($validator)
    {
        if ($this->isMethod('post')) {
            
            
           // dd($leaveId);
        $validator->after(function ($validator) {
            $totalDays =Carbon::parse($this->from_date)->diffInDays(Carbon::parse($this->to_date)) + 1;
            $leaveId=$this->id;
            $leaveQuery = Leave::where('user_id',auth()->id())
                ->whereIn('status', ['pending', 'approved']);
            if ($leaveId) {
                $leaveQuery->where('id', '!=', $leaveId);
            }    
                $exists = $leaveQuery->where(function ($q) {

                    $q->whereBetween('from_date', [
                        $this->from_date,
                        $this->to_date
                    ])
                    ->orWhereBetween('to_date', [
                        $this->from_date,
                        $this->to_date
                    ])
                    ->orWhere(function ($q2) {

                        $q2->where('from_date', '<=', $this->from_date)
                        ->where('to_date', '>=', $this->to_date);
                    });
                })
                ->exists();

            if ($exists) {
                $validator->errors()->add(
                    'from_date',
                    'Leave dates overlap with an existing leave.'
                );
            }
            $leaveBalance = LeaveBalance::where('user_id',auth()->id())->where('leave_type_id',$this->leave_type_id)->first();

            if (!$leaveBalance) {
                $validator->errors()->add(
                    'leave_type_id',
                    'Leave balance not found.'
                );

        } else {
            if($leaveId){
                $oldLeave = Leave::find($leaveId);
                $availableDays = $leaveBalance->balance_days;

                if ($oldLeave) {
                    $availableDays += $oldLeave->total_days;
                }

                if ($availableDays < $totalDays) {
                    $validator->errors()->add(
                        'leave_type_id',
                        'Insufficient leave balance.'
                    );
                }

            }else{
                if ($leaveBalance->balance_days < $totalDays) {
                    $validator->errors()->add(
                        'leave_type_id',
                        'Insufficient leave balance.'
                    );
                }
            }
        }
        });
    }
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
