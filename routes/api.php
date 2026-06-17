<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ReportController;

Route::get(
    '/attendance-summary',
    [ReportController::class, 'attendanceSummary']
);
        


