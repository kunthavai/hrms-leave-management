<form action="{{ route('applyLeave') }}" method="POST" class="formCls">
                                               @csrf
                                               
                       
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addTaskModalLabel">Apply Leavee</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="text" id="edit-leave-id" name="id" value="{{$leave->id}}">
                                <div class="mb-3">
                                    <label for="edit-department" class="form-label">Leave Type</label>
                                    <select name="leave_type_id" class="form-control">
                                    <option value="">Select Leave Type</option>

                                    @foreach($leaveTypes as $leaveType)
                                        <option value="{{ $leaveType->id }}"
                                            {{ $leave->leave_type_id == $leaveType->id ? 'selected' : '' }}>
                                            {{ $leaveType->name }}
                                        </option>
                                    @endforeach
                                </select>
                                    <span class="text-danger error" id="error-leave_type_id"></span>
                                </div>
                                 <div class="mb-3">
                                    <label for="edit-joining_date" class="form-label">From Date</label>
                                    <input type="date" class="form-control" id="from_date" name="from_date" value="{{  $leave->from_date?->format('Y-m-d') }}" required>
                                    <span class="text-danger error" id="error-from_date"></span>
                                </div>
                                 <div class="mb-3">
                                    <label for="edit-joining_date" class="form-label">To Date</label>
                                    <input type="date" class="form-control" id="to_date" name="to_date" value="{{  $leave->to_date?->format('Y-m-d') }}" required>
                                    <span class="text-danger error" id="error-to_date"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="edit-name" class="form-label">Reason</label>
                                    <textarea name="reason" class="form-control" id="reason">{{ $leave->reason }}</textarea>
                                    
                                    <span class="text-danger error" id="error-reason"></span>
                                </div>
                                
                                
                               
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update Leave</button>
                            </div>
                        </div>
                    </form>
                    

    
   