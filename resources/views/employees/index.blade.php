@extends('layouts.master')

@section('content')
@if(session('success') || request('success'))
    <div class="alert alert-success">
        {{ session('success') ?? request('success') }}
    </div>
    @endif
 <button type="button" class="btn btn-secondary mb-1 addCls" id="addEmployee"  data-url="{{ route('employees.create') }}" style="margin-left: 16px">Add Employee</button>&nbsp;&nbsp;
<div class="content mt-3">
   <div class="row">
   <div class="col-lg-12">
<div class="card">
    <div class="card-header">
        <strong>Employee List</strong>
    </div>
    <div class="card-body card-block">
    <table class="table" border="1">
    <thead>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Email</th>
            <th>Department</th>
            <th>Joining Date</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

    @foreach($employees as $employee)

        <tr>

            <td>{{ $employee->employee_code }}</td>

            <td>{{ $employee->name }}</td>

            <td>{{ $employee->user->email }}</td>

            <td>{{ $employee->department->name }}</td>

            <td>{{ $employee->joining_date }}</td>
            
            <td>
                <a href="javascript:void(0)" data-url="{{ route('employees.getDetails', $employee->id) }}" class="actionCls" data-action="edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>&nbsp;&nbsp;&nbsp;
                <a href="javascript:void(0)" data-url="{{ route('employees.getDetails', $employee->id) }}" class="actionCls" data-action="delete">
                             <i class="fa-solid fa-trash"></i>
                        </a>        
                

                

            </td>

        </tr>

    @endforeach

    </tbody>

</table>

{{ $employees->links() }}


<!-- Pagination Info -->

 </div> </div> </div> </div> </div>
  <div class="modal fade" id="modalFade" tabindex="-1">
  <div class="modal-dialog" id="modalContent">
    </div>
  </div>




@endsection