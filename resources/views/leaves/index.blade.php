@extends('layouts.master')

@section('content')

   @if(session('success') || request('success'))
    <div class="alert alert-success">
        {{ session('success') ?? request('success') }}
    </div>
    @endif
    
 
 <button type="button" class="btn btn-secondary mb-1 addCls" id="applyLeave"  data-url="{{ route('applyLeave') }}" style="margin-left: 16px">Apply Leave</button>&nbsp;&nbsp;
<div class="content mt-3">
   <div class="row">
   <div class="col-lg-12">
<div class="card">
    <div class="card-header">
        <strong>Leave History</strong>
    </div>
    <div class="card-body card-block">
    <table id="leaveTable" class="table table-bordered">
    <thead>
        <tr>
            <th>Employee</th>
            <th>Leave Type</th>
            <th>From Date</th>
            <th>To Date</th>
            <th>Total Days</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
</table>


<!-- Pagination Info -->

 </div> </div> </div> </div> </div>
  <div class="modal fade" id="modalFade" tabindex="-1">
  <div class="modal-dialog" id="modalContent">
    </div>
  </div>
  <script type="text/javascript">
jQuery(document).ready(function ($) {
    $('#leaveTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('leaves') }}",
    columns: [
        { data: 'employee_name', name: 'user.name' },
        { data: 'leave_type', name: 'leaveType.name' },
        { data: 'from_date', name: 'from_date' },
        { data: 'to_date', name: 'to_date' },
        { data: 'total_days', name: 'total_days' },
        { data: 'status', name: 'status' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
});
});
  </script>




@endsection