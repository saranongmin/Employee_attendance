<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
class UserController extends Controller
{
  public function index()
    {
        $this->authorize('users.viewAny');
        $sl = !is_null(\request()->page) ? (\request()->page -1 )* 10 : 0;

        $users = User::orderBy('created_at', 'asc')->get();

        return view('backend.users.index', compact('users', 'sl'));
        
    }  
    public function edit(User $user)
    {
       
        // $user = User::where('id',$id)->firstOrFail();

        return view('backend.users.edit',compact('user'));
    }
    public function update(Request $request,User $user)
    {
        // $user = User::where('id',$id)->firstOrFail();
        // $userData = $request->only('name', 'role');
        // $user->update($userData);
        // return redirect()->route('users.index');
        try{
            $user->update($request->all());
            return redirect()->route('users.index')->withStatus('Updated Successfully !');
        }catch (QueryException $e){
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
        
    }
     public function destroy(User $user)
    {
        try{
            $user->delete();
            return redirect()->route('users.index')->withStatus('Deleted Successfully !');
        }catch (QueryException $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function myProfile()
    {
        $user = auth()->user();
        return view('backend.users.userprofile', compact('user'));
    }

    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
