@extends('layouts.master')

@section('content')
@if(session('success') || request('success'))
    <div class="alert alert-success">
        {{ session('success') ?? request('success') }}
    </div>
    @endif
 
 <button
            class="btn btn-success"
            id="approveSelected">

            Approve Selected

        </button>
<div class="content mt-3">
   <div class="row">
   <div class="col-lg-12">
<div class="card">
    <div class="card-header">
        <strong>Leave Approval Requests</strong>
    </div>
    <div class="card-body card-block">
    <table
        class="table table-bordered"
        id="pendingLeaveTable">

        <thead>
            <tr>
                <th>
                    <input type="checkbox" id="selectAll">
                </th>
                <th>Employee</th>
                <th>Leave Type</th>
                <th>From</th>
                <th>To</th>
                <th>Days</th>
                <th>Reason</th>
                <th>Action</th>
            </tr>
        </thead>

    </table>


<!-- Pagination Info -->

 </div> </div> </div> </div> </div>
  <div class="modal fade" id="rejectModal">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
                <h5>Reject Leave</h5>
            </div>

            <div class="modal-body">

                <input
                    type="hidden"
                    id="leave_id">

                <textarea
                    id="admin_comment"
                    class="form-control"></textarea>

            </div>

            <div class="modal-footer">

                <button
                    class="btn btn-danger"
                    id="confirmReject">

                    Reject

                </button>

            </div>

        </div>

    </div>

</div>
  <script type="text/javascript">
    const pendingLeavesUrl = "{{ route('pendingLeaves') }}";
    const bulkApproveUrl = "{{ route('leaveBulkApprove') }}";
    const rejectUrl = "{{ route('leaveBulkReject') }}";
jQuery(document).ready(function ($) {
    let table = $('#pendingLeaveTable').DataTable({

        processing: true,
        serverSide: true,

        ajax: pendingLeavesUrl,

        columns: [
            {
                data: 'checkbox',
                orderable: false,
                searchable: false
            },
            {
                data: 'employee_name'
            },
            {
                data: 'leave_type'
            },
            {
                data: 'from_date'
            },
            {
                data: 'to_date'
            },
            {
                data: 'total_days'
            },
            {
                data: 'reason'
            },
            {
                data: 'action',
                orderable: false,
                searchable: false
            }
        ]
    });

    $('#selectAll').change(function () {
        alert("daSD");
        $('.leave-checkbox').prop(
            'checked',
            $(this).prop('checked')
        );

    });
    $(document).on('change', '.leave-checkbox', function () {
        let totalCheckboxes = $('.leave-checkbox').length;
        let checkedCheckboxes = $('.leave-checkbox:checked').length;
        alert("ASdasdas");
        $('#selectAll').prop(
            'checked',
            totalCheckboxes === checkedCheckboxes
        );
    });

    $('#approveSelected').click(function () {

        let leaveIds = [];

        $('.leave-checkbox:checked').each(function () {

            leaveIds.push($(this).val());

        });

        if (!leaveIds.length) {
            alert('Select leave');
            return;
        }

        $.post(
            bulkApproveUrl,
            {
               // _token: csrfToken,
                leave_ids: leaveIds
            },
            function () {
                table.ajax.reload();
            }
        );
    });

    $(document).on(
        'click',
        '.rejectLeave',
        function () {

            $('#leave_id').val(
                $(this).data('id')
            );

            $('#rejectModal').modal('show');
        }
    );

    $('#confirmReject').click(function () {

        $.post(
            rejectUrl,
            {
                //_token: csrfToken,
                leave_id: $('#leave_id').val(),
                comment: $('#admin_comment').val()
            },
            function () {

                $('#rejectModal').modal('hide');

                $('#admin_comment').val('');

                table.ajax.reload();
            }
        );
    });
});
  </script>




@endsection