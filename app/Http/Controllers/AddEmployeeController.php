<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AddEmployee;
use App\Http\Requests\AddEmployeeRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class AddEmployeeController extends Controller
{
    public function index()
    {
        $sl = !is_null(\request()->page) ? (\request()->page -1 )* 10 : 0;

        $addEmployees= AddEmployee::orderBy('created_at', 'desc')->get();

        return view('backend.add-employees.index', compact('addEmployees', 'sl'));
    }

        public function create()

    {
       
        return view('backend.add-employees.create');
    }


  public function store(Request $request)
    {
      
        try {        
           $data = $request->all();
            $data['created_by'] = auth()->user()->id;

            AddEmployee::create($data);
           return redirect()->route('add-employees.index')->withStatus('Created Successfully !');
        }catch (QueryException $e){
          return redirect()->back()->withInput()->withErrors($e->getMessage());
    

        }
    }
    public function show(AddEmployee $addEmployee)
    {
        return view('backend.add-employees.show',compact($addEmployee));

    }


    public function edit(AddEmployee $addEmployee)
    {
return view('backend.add-employees.edit',compact('addEmployee'));

    }
    public function update(AddEmployeeRequest $request,AddEmployee $addEmployee)
    {

        try{
            $addEmployee->update($request->all());
            return redirect()->route('add-employees.index')->withStatus('Updated Successfully !');
        }catch (QueryException $e){
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }
    public function destroy(AddEmployee $addEmployee)
    {
         try{
            $addEmployee->delete();
            return redirect()->route('add-employees.index')->withStatus('Deleted Successfully !');
        }catch (QueryException $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
