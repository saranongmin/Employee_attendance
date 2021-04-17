<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanyProfile;
use App\EmployeeProfile;
use App\Http\Requests\EmployeeProfileRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Policies\ProfilePolicy;
class EmployeeProfileController extends Controller
{
    public function index()
    {
// $this->authorize('profiles.viewAny');
        $sl = !is_null(\request()->page) ? (\request()->page -1 )* 10 : 0;

        $employeeProfiles= EmployeeProfile::orderBy('created_at', 'desc')->get();

        return view('backend.employee-profiles.index', compact('employeeProfiles', 'sl'));
    }

public function create()

    {
       $this->authorize('create');

        return view('backend.employee-profiles.create');
    }

    public function store(Request $request)
    {
        try {
          
            $data = $request->all();
            $data['created_by'] = auth()->user()->id;

            EmployeeProfile::create($data);
            return redirect()->route('employee-profiles.index')->withStatus('Created Successfully !');
        }catch (QueryException $e){
        return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }



public function show($id) //route model model binding/ dependency injection
    {

        $employeeProfile = EmployeeProfile::find($id);

        return view('backend.employee-profiles.show', compact('employeeProfile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeProfile $employeeProfile)
    {

     return view('backend.employee-profiles.edit', compact('employeeProfile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeProfile $employeeProfile)
    {
        try{
            $data = $request->all();
            
            $employeeProfile->update($data);
            return redirect()->route('employee-profiles.index')->withStatus('Updated Successfully !');
        }catch (QueryException $e){
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeProfile $employeeProfile)
    {
        try{
            $employeeProfile->delete();
            return redirect()->route('employee-profiles.index')->withStatus('Deleted Successfully !');
        }catch (QueryException $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

}
