<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LeaveRequest;
use App\Repositories\LeaveRepository;
use App\Models\LeaveType;
use App\Models\Employee;
use App\Models\Leave;
use Yajra\DataTables\Facades\DataTables;
class LeaveController extends Controller
{
    public function __construct(LeaveRepository $leaveRepository) {
        $this->leaveRepository = $leaveRepository;
    }
    public function index(Request $request)
    {
       // dd(auth()->id());
        if ($request->ajax()) {
            $leaves = $this->leaveRepository->getLeaves();
            return DataTables::of($leaves)
                ->addColumn('employee_name', function ($row) {
                    return $row->user?->name;
                })
                ->addColumn('leave_type', function ($row) {
                    return $row->leaveType?->name;
                })
                ->editColumn('from_date', function ($row) {
                    return $row->from_date;
                })
                ->editColumn('to_date', function ($row) {
                    return $row->to_date;
                })
                ->addColumn('action', function ($row) {

                    //$editUrl = route('leaves.edit', $row->id);
                    if($row->status=="pending"){
                    return '
                     <a href="javascript:void(0)" data-url="'.route('leaves.getDetails', $row->id).'" class="actionCls" data-action="edit">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="javascript:void(0)" data-url="'.route('leaves.getDetails', $row->id).'" class="actionCls" data-action="delete">
                            <i class="fa-solid fa-trash"></i>
                        </a>';
                    }
                    else{
                        return '-';
                    }
                })

                ->rawColumns(['action'])
                ->make(true);
        }

        return view('leaves.index');
    }
    public function getLeave(Leave $leave,Request $request){        
        $action = $request->input('action');
        $leaveTypes = LeaveType::where('status',1)->get();
        if ($action === 'delete') {
            return view('leaves.delete', compact('leave'));
        }
        //dd($leave->from_date);
        return view('leaves.edit', compact('leave','leaveTypes'));
    }
    public function  applyLeave(LeaveRequest $request){             
        if ($request->isMethod('post')) {
            $id = $request->id ?? null;          
             $this->leaveRepository->saveLeave($request->validated(),$id);   
            
            
              return response()->json([
                    'redirect_url' => route('leaves', [
                        'success' => $id ? 'Leave updated successfully!' : 'Leave added successfully!'
                    ]),
                    'message' => $id ? 'Leave updated successfully!' : 'Leave added successfully!'
                ]);
        }
        $leaveTypes = LeaveType::select('id', 'name')->get();
        return view('leaves.add',compact('leaveTypes'));
    }
     public function delete($id)
    {      
        $this->leaveRepository->deleteLeave($id);
        return redirect()->back()->with('success', 'Leave Deleted successfully');

    }
    public function pendingLeaves(Request $request)
    {
        if ($request->ajax()) {

            $leaves = $this->leaveRepository->getPendingLeaves();
            //dd($leaves);
            return DataTables::of($leaves)

                ->addColumn('checkbox', function ($row) {
                    return '<input type="checkbox"
                                class="leave-checkbox"
                                value="'.$row->id.'">';
                })

                ->addColumn('employee_name', function ($row) {
                    return $row->user?->name;
                })

                ->addColumn('leave_type', function ($row) {
                    return $row->leaveType?->name;
                })

                ->addColumn('action', function ($row) {
                    return '
                        <button
                            class="btn btn-danger btn-sm rejectLeave"
                            data-id="'.$row->id.'">
                            Reject
                        </button>';
                })
                ->editColumn('from_date', function ($row) {
                    return $row->from_date?->format('d-m-Y');
                })

                ->editColumn('to_date', function ($row) {
                    return $row->to_date?->format('d-m-Y');
                })
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }

        return view('leaves.pending_leaves');
    }
    public function leaveBulkApprove(Request $request)
    {
        $request->validate([
            'leave_ids' => ['required', 'array']
        ]);

        $this->leaveRepository->bulkApprove(
            $request->leave_ids
        );

        return response()->json([
            'success' => true
        ]);
    }
    public function leaveBulkReject(Request $request)
    {
        $request->validate([
            'leave_id' => ['required'],
            'comment'  => ['required']
        ]);

        $this->leaveRepository->rejectLeave(
            $request->leave_id,
            $request->comment
        );

        return response()->json([
            'success' => true
        ]);
    }
}
