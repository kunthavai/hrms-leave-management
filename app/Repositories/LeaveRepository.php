<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use App\Models\LeaveBalance;
use App\Models\LeaveType;
use App\Models\Leave;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class LeaveRepository
{
    public function getLeaves()
    {   
        return Leave::with(['user', 'leaveType'])->where('user_id',auth()->id())
            ->select('leaves.*');
    }
    public function getPendingLeaves()
    {
        return Leave::with(['user', 'leaveType'])
            ->where('status', 'pending')
            ->select('leaves.*');
    }
    public function saveLeave(array $data, ?int $leaveId = null)
    {
        //dd("dsfsdf");
        $totalDays = $this->calculateLeaveDays(
            $data['from_date'],
            $data['to_date']
        );

        if ($leaveId) {

            $leave = Leave::where('id', $leaveId)
                ->where('user_id', auth()->id())
                ->firstOrFail();

            $leave->update([
                'leave_type_id' => $data['leave_type_id'],
                'from_date'     => $data['from_date'],
                'to_date'       => $data['to_date'],
                'total_days'    => $totalDays,
                'reason'        => $data['reason'],
            ]);

            return $leave;
        }

        return Leave::create([
            'user_id'       => auth()->id(),
            'leave_type_id' => $data['leave_type_id'],
            'from_date'     => $data['from_date'],
            'to_date'       => $data['to_date'],
            'total_days'    => $totalDays,
            'reason'        => $data['reason'],
            'status'        => 'pending',
        ]);
    }
    public function deleteLeave($leaveId){
        $leave = Leave::findOrFail($leaveId);        
        $leave->update(['status'=>'cancelled']);
                
    }
    private function calculateLeaveDays(string $fromDate,string $toDate): int {

        $from = Carbon::parse($fromDate);
        $to   = Carbon::parse($toDate);

        $totalDays = $from->diffInDays($to) + 1;

        return $this->applySandwichRule($from,$to,$totalDays);
    }

    private function applySandwichRule(Carbon $from,Carbon $to,int $totalDays): int {

        /*
         * Example:
         *
         * Friday    Leave
         * Saturday  WO
         * Sunday    WO
         * Monday    Leave
         *
         * Count all 4 days
         */

        $previousDay = $from->copy()->subDay();
        $nextDay = $to->copy()->addDay();

        $previousLeave = Leave::where('user_id',auth()->id())->where('status', 'approved')->whereDate('to_date', $previousDay)->exists();

        $nextLeave = Leave::where('user_id',auth()->id())->where('status', 'approved')->whereDate('from_date', $nextDay)->exists();

        if ($previousLeave &&$nextLeave &&$previousDay->isWeekend() &&$nextDay->isWeekend()) {
            $totalDays += 2;
        }

        return $totalDays;
    }

    public function bulkApprove(array $leaveIds)
    {
        DB::transaction(function () use ($leaveIds) {

            $leaves = Leave::whereIn('id', $leaveIds)
                ->where('status', 'pending')
                ->get();

            foreach ($leaves as $leave) {

                $balance = LeaveBalance::where('user_id', $leave->user_id)
                    ->where('leave_type_id', $leave->leave_type_id)
                    ->first();

                if (!$balance) {
                    continue;
                }

                if ($balance->balance_days < $leave->total_days) {
                    continue;
                }
                $balance->update([
                'availed_days' => $balance->availed_days + $leave->total_days,
                'balance_days' => $balance->balance_days - $leave->total_days,
                ]);
                

                $leave->update([
                    'status'        => 'approved',
                    'approved_by'   => auth()->id(),
                    'approved_at'   => now(),
                ]);
            }
        });
    }

    public function rejectLeave(
        int $leaveId,
        string $comment
    )
    {
        $leave = Leave::where('id', $leaveId)
            ->where('status', 'pending')
            ->firstOrFail();

        $leave->update([
            'status'         => 'rejected',
            'admin_remark'  => $comment,
            'approved_by'    => auth()->id(),
            'approved_at'    => now(),
        ]);
    }
    public function getLeaveStatistics(): array
    {
        $today = today();

        $totalLeaves = Leave::count();

        $pendingLeaves = Leave::where(
            'status',
            'pending'
        )->count();

        $approvedLeaves = Leave::where(
            'status',
            'approved'
        )->count();

        $rejectedLeaves = Leave::where(
            'status',
            'rejected'
        )->count();

        $onLeaveToday = Leave::where(
            'status',
            'approved'
        )
        ->whereDate('from_date', '<=', $today)
        ->whereDate('to_date', '>=', $today)
        ->count();

        $mostUsedLeaveType = Leave::selectRaw(
            'leave_type_id, COUNT(*) as total'
        )
        ->groupBy('leave_type_id')
        ->orderByDesc('total')
        ->with('leaveType')
        ->first();
        $recentLeaves = Leave::with([
        'user',
        'leaveType'
        ])
        ->latest()
        ->take(5)
        ->get();

        return [
            'total_leaves'         => $totalLeaves,
            'pending_leaves'       => $pendingLeaves,
            'approved_leaves'      => $approvedLeaves,
            'rejected_leaves'      => $rejectedLeaves,
            'on_leave_today'       => $onLeaveToday,
            'most_used_leave_type' => $mostUsedLeaveType?->leaveType?->name ?? '-',
            'recentLeaves'=>$recentLeaves,
        ];
    }
    
}
