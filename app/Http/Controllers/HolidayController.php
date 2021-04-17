<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HolidayRequest;
use App\Holiday;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
class HolidayController extends Controller
{
   public function index()
    {
   $sl = !is_null(\request()->page) ? (\request()->page -1 )* 10 : 0;
       
        $holidays= Holiday::orderBy('created_at', 'desc')->get();
       
        return view('backend.holidays.index', compact('holidays', 'sl')); 
    }
    public function create()

    {

        return view('backend.holidays.create');
    }



     public function store(Request $request)
    {

        try {
          
            $data = $request->all();
            $data['created_by'] = auth()->user()->id;
            Holiday::create($data);
            return redirect()->route('holidays.index')->withStatus('Successful in assign the Emergency Leave  !');
        }catch (QueryException $e){
        return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }
    
 public function edit(Holiday $holiday)
    {
return view('backend.holidays.edit',compact('holiday'));

    }
    public function update(HolidayRequest $request,Holiday $holiday)
    {

        try{
            $holiday->update($request->all());
            return redirect()->route('holidays.index')->withStatus('Updated Successfully !');
        }catch (QueryException $e){
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

public function destroy(Holiday $holiday)
{
       
         try{
            $holiday->delete();
            return redirect()->route('holidays.index')->withStatus('Deleted Successfully !');
        }catch (QueryException $e){
            return redirect()->back()->withErrors($e->getMessage());
        }   

} 
}
