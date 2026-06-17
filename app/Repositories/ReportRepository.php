<?php

namespace App\Repositories;

use App\Models\Leave;
use App\Models\User;

class ReportRepository
{
    public function getAttendanceSummary(): array
    {
        $totalEmployees = User::count();

        $onLeave = Leave::where('status', 'approved')
            ->whereDate('from_date', '<=', today())
            ->whereDate('to_date', '>=', today())
            ->count();

        // No attendance table available.
        // Assuming employees not on leave are present.
        $weekOff = 0;

        $present = $totalEmployees - $onLeave - $weekOff;

        return [
            'total_employees' => $totalEmployees,
            'present'         => $present,
            'absent'          => 0,
            'on_leave'        => $onLeave,
            'week_off'        => $weekOff,
        ];
    }
}