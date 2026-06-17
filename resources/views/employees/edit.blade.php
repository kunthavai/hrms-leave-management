<form action="{{ route('employees.create') }}" method="POST" class="formCls"> 
                                               @csrf
                                               
                       
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addTaskModalLabel">Edit Employee</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="edit-user-id" name="id" value="{{ $employee->id }}">
                                
                                <div class="mb-3">
                                    <label for="edit-name" class="form-label">Employee Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{$employee->name}}" >
                                    <span class="text-danger error" id="error-name"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="edit-code" class="form-label">Employee Code</label>
                                    <input type="text" class="form-control" id="employee_code" name="employee_code" value="{{$employee->employee_code}}" required>
                                    <span class="text-danger error" id="error-employee_code"></span>
                                </div>
                                 <div class="mb-3">
                                    <label for="edit-email" class="form-label">Employee Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{$employee->email}}" required>
                                    <span class="text-danger error" id="error-email"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="edit-phone" class="form-label">Employee Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{$employee->phone}}" required>
                                    <span class="text-danger error" id="error-phone"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="edit-department" class="form-label">Employee Department</label>
                                    <select name="department_id" class="form-control">
                                    <option value="">Select Department</option>

                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}"
                                            {{ $employee->department_id == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                                    <span class="text-danger error" id="error-department_id"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="edit-joining_date" class="form-label">Employee Joining Date</label>
                                    <input type="date" class="form-control" id="joining_date" name="joining_date" value="{{$employee->joining_date}}" required>
                                    <span class="text-danger error" id="error-joining_date"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Edit Employee</button>
                            </div>
                        </div>
                    </form>
                    

    
   