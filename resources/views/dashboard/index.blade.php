@extends('layouts.master')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">
                Leave Management Dashboard
            </h2>
            <small class="text-muted">
                HR Leave Statistics Overview
            </small>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="dashboard-card bg-primary">
                <div>
                    <h6>Total Leave Requests</h6>
                    <h2>{{ $statistics['total_leaves'] }}</h2>
                </div>
                <i class="fa-solid fa-file-circle-check"></i>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card bg-warning">
                <div>
                    <h6>Pending Requests</h6>
                    <h2>{{ $statistics['pending_leaves'] }}</h2>
                </div>
                <i class="fa-solid fa-hourglass-half"></i>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card bg-success">
                <div>
                    <h6>Approved Requests</h6>
                    <h2>{{ $statistics['approved_leaves'] }}</h2>
                </div>
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card bg-danger">
                <div>
                    <h6>Rejected Requests</h6>
                    <h2>{{ $statistics['rejected_leaves'] }}</h2>
                </div>
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card bg-info">
                <div>
                    <h6>Employees On Leave Today</h6>
                    <h2>{{ $statistics['on_leave_today'] }}</h2>
                </div>
                <i class="fa-solid fa-user-clock"></i>
            </div>
        </div>

        <div class="col-md-4">
            <div class="dashboard-card bg-dark">
                <div>
                    <h6>Most Used Leave Type</h6>
                    <h5>
                        {{ $statistics['most_used_leave_type'] }}
                    </h5>
                </div>
                <i class="fa-solid fa-chart-pie"></i>
            </div>
        </div>

    </div>

    <div class="card shadow border-0 mt-5">

        <div class="card-header bg-white">
            <h5 class="mb-0">
                Recent Leave Requests
            </h5>
        </div>

        <div class="card-body p-0">

            <table class="table table-hover mb-0">

                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Leave Type</th>
                        <th>Status</th>
                        <th>From</th>
                        <th>To</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($statistics['recentLeaves'] as $leave)

                    <tr>

                        <td>
                            {{ $leave->user?->name }}
                        </td>

                        <td>
                            {{ $leave->leaveType?->name }}
                        </td>

                        <td>

                            @if($leave->status=='approved')
                                <span class="badge bg-success">
                                    Approved
                                </span>

                            @elseif($leave->status=='pending')

                                <span class="badge bg-warning">
                                    Pending
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    Rejected
                                </span>

                            @endif

                        </td>

                        <td>
                            {{ $leave->from_date->format('d-m-Y') }}
                        </td>

                        <td>
                            {{ $leave->to_date->format('d-m-Y') }}
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="text-center">
                            No Records Found
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>




@endsection