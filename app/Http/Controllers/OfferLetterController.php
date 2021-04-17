<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Request\OfferLetterRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\OfferLetter;
class OfferLetterController extends Controller
{

	public function index()
	{
    // $this->authorize('offer-letters.viewAny');
		$sl = !is_null(\request()->page) ? (\request()->page -1 )* 20 : 0;

        $offerLetters = OfferLetter::orderBy('created_at', 'asc')->paginate(20);

        return view('backend.offer-letters.index', compact('offerLetters', 'sl'));
	}
    public function create()
    {
    	return view('backend.offer-letters.create');
    }
    public function store(Request $request)
    {
      try{
      	OfferLetter::create($request->all());
      	return redirect()->route('offer-letters.index')->withStatus('Successfully Sent');
      }
      catch(QueryException $e){
     return redirect()->back()->withInput()->withErros($e->getMessage());
      }

    }
    public function show(OfferLetter $offerLetter)
    {
    	return view('backend.offer-letters.show',compact($offerLetter));
    }


public function edit(OfferLetter $offerLetter)
 {
    // $this->authorize('update');
 return view('backend.offer-letters.edit',compact('offerLetter'));

 }
 public function update(Request $request,OfferLetter $offerLetter)
 {
// $this->authorize('update');
     try{
            $offerLetter->update($request->all());
            return redirect()->route('offer-letters.index')->withStatus('Offer Letter Has Been Updated  Successfully !');
        }catch (QueryException $e){
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
 }




    public function destroy(OfferLetter $offerLetter)
    {
       try{
            $offerLetter->delete();
            return redirect()->route('offer-letters.index')->withStatus('Deleted Successfully !');
        }catch (QueryException $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
