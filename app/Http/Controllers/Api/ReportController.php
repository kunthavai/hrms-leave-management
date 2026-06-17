<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ReportRepository;
use Illuminate\Http\JsonResponse;

class ReportController extends Controller
{
    protected ReportRepository $reportRepository;

    public function __construct(
        ReportRepository $reportRepository
    ) {
        $this->reportRepository = $reportRepository;
    }

    public function attendanceSummary(): JsonResponse
    {
        $summary = $this->reportRepository
            ->getAttendanceSummary();

        return response()->json([
            'success' => true,
            'data'    => $summary,
            'message' => 'Attendance summary fetched successfully.'
        ]);
    }
}


