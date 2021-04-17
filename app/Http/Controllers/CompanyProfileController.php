<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanyProfile;
use App\Http\Requests\CompanyProfileRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CompanyProfileController extends Controller
{
    public function index()
    {
        $this->authorize('company-profiles.viewAny');

    $sl = !is_null(\request()->page) ? (\request()->page -1 )* 20 : 0;

        $companyProfiles = CompanyProfile::orderBy('created_at', 'asc')->paginate(20);

        return view('backend.company-profiles.index', compact('companyProfiles', 'sl'));
    }

    public function create()

    {
       
        return view('backend.company-profiles.create');
    }

    public function store(CompanyProfileRequest $request)
    {
      
        try {        
           

            CompanyProfile::create($request->all());
            return redirect()->route('company-profiles.index')->withStatus('Created Successfully !');
        }catch (QueryException $e){
          return redirect()->back()->withInput()->withErrors($e->getMessage());
    

        }
    }
    public function show(CompanyProfile $companyProfile)
    {

        return view('backend.company-profiles.show', compact('companyProfile'));
    
    }

public function edit(CompanyProfile $companyProfile)
{
    return view('backend.company-profiles.edit',compact('companyProfile'));
}

public function update(CompanyProfileRequest $request,CompanyProfile $companyProfile)
{

     try{
            $companyProfile->update($request->all());
            return redirect()->route('company-profiles.index')->withStatus('Updated Successfully !');
        }catch (QueryException $e){
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
}

public function destroy(CompanyProfile $companyProfile)
{
    try{
            $companyProfile->delete();
            return redirect()->route('company-profiles.index')->withStatus('Deleted Successfully !');
        }catch (QueryException $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
}

}
