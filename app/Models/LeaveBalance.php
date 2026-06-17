<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class LeaveBalance extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'leave_type_id',
        'allocated_days',
        'availed_days',
        'balance_days',
        'status',
    ];

    protected $casts = [
        'allocated_days' => 'decimal:2',
        'availed_days'   => 'decimal:2',
        'balance_days'   => 'decimal:2',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class);
    }
}
