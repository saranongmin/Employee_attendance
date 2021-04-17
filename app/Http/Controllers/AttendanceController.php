<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Attendance;
use App\EmployeeProfile;
use App\Exports\AttendanceExport;
use App\Request\AttendanceRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use PDF;

class AttendanceController extends Controller
{
   public function index()
    {
         // $this->authorize('viewAny');
        $sl = !is_null(\request()->page) ? (\request()->page -1 )* 10 : 0;
        // $sl = Attendance::paginate();
        // $data = $sl->makeHidden(['log_type']);
        // $sl->data =$data;
        $attendances= Attendance::orderBy('created_at', 'desc')->get();
       
        return view('backend.attendances.index', compact('attendances', 'sl'));
    } 

    public function create()

    {

        return view('backend.attendances.create');
    }

    public function store(Request $request)
    {

        try {
          
            $data = $request->all();
            $data['created_by'] = auth()->user()->id;
            Attendance::create($data);
            return redirect()->route('attendances.index')->withStatus('Successful in assign the attendance !');
        }catch (QueryException $e){
        return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

 public function show(Attendance $attendance)
 {
return view('backend.attendances.show',compact('attendance'));

 }

 public function edit(Attendance $attendance)
 {
    // $this->authorize('update');
 return view('backend.attendances.edit',compact('attendance'));

 }
 public function update(Request $request,Attendance $attendance)
 {
// $this->authorize('update');
     try{
            $attendance->update($request->all());
            return redirect()->route('attendances.index')->withStatus('Attendance Has Been Updated  Successfully !');
        }catch (QueryException $e){
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
 }

public function destroy(Attendance $attendance)
{
        // $this->authorize('delete()');
    try{
            $attendance->delete();
            return redirect()->route('attendances.index')->withStatus('Attendance Has Been Deleted Successfully !');
        }catch (QueryException $e){
            return redirect()->back()->withErrors($e->getMessage());
        }

}


}
