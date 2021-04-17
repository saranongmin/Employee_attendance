<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
class AppointmentController extends Controller
{
  public function index()
  {
  	$sl = !is_null(\request()->page) ? (\request()->page -1 )* 20 : 0;

        $appointments = Appointment::orderBy('created_at', 'asc')->paginate(20);

        return view('backend.appointments.index', compact('appointments', 'sl'));
  }  
  public function create()
  {
  	return view('backend.appointments.create');
  }

  public function store(Request $request)
  {
  	try{
      	Appointment::create($request->all());
      	return redirect()->route('appointments.index')->withStatus('Successfully Sent');
      }
      catch(QueryException $e){
     return redirect()->back()->withInput()->withErros($e->getMessage());
      }
  }
  public function edit(Appointment $appointment)
  {
  	return view('backend.appointments.edit',compact($appointment));
  }
  public function update(AppointmentRequest $request,Appointment $appointment)
  {

  	 try{
            $appointment->update($request->all());
            return redirect()->route('appointments.index')->withStatus('Updated Successfully !');
        }catch (QueryException $e){
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
  }
  public function destroy(Appointment $appointment)
  {

    try{
          $appointment->delete();
          return redirect()->route('appointments.index')->withStatus('Deleted Successfully !');
        }catch (QueryException $e){
            return redirect()->back()->withErrors($e->getMessage());
        }



  }
}
