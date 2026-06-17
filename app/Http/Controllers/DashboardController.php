<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\LeaveRepository;

class DashboardController extends Controller
{
    public function __construct(LeaveRepository $leaveRepository) {
        $this->leaveRepository = $leaveRepository;
    }
    public function index()
    {
        $statistics = $this->leaveRepository
            ->getLeaveStatistics();

        return view(
            'dashboard.index',
            compact('statistics')
        );
    }
}
