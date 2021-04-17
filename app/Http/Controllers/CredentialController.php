<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Credential;
class CredentialController extends Controller
{
	public function index()
    {
        $this->authorize('viewAny');
        $sl = !is_null(\request()->page) ? (\request()->page -1 )* 10 : 0;

        $credentials= Credential::orderBy('created_at', 'desc')->get();

        return view('backend.credentials.index', compact('credentials', 'sl'));
    }
    public function create()

    {
        $this->authorize('create');

        return view('backend.credentials.create');
    }

    public function store(Request $request)
    {
      
        try {        
           $data = $request->all();
            $data['created_by'] = auth()->user()->id;

            Credential::create($data);
           return redirect()->route('credentials.index')->withStatus('Created Successfully !');
        }catch (QueryException $e){
          return redirect()->back()->withInput()->withErrors($e->getMessage());
    

        }
    }
    public function show(Credential $credential)
    {
                return view('backend.credentials.show');

    }

public function destroy(Credential $credential)
{
    try{
            $credential->delete();
            return redirect()->route('credentials.index')->withStatus('Deleted Successfully !');
        }catch (QueryException $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
}


 }
