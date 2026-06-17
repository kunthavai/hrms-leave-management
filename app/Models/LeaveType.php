<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class LeaveType extends Model
{

    use SoftDeletes;
    protected $fillable = [
        'name',
        'code',
        'default_days',
        'status',
    ];

    protected $casts = [
        'status' => 'integer',
        'default_days' => 'integer',
    ];
    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }
}
