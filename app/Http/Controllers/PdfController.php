<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attendance;
use App\Credential;
use App\CompanyProfile;
use PDF;

class PdfController extends Controller
{
	public function attendances()
    {

        $attendances = Attendance::orderBy('created_at', 'desc')->get();

        $pdf = PDF::loadView('backend.attendances.pdf', compact('attendances'));
        return $pdf->download('attendances.pdf');
    }
    
    public function credentials()
    {
$credentials = Credential::orderBy('created_at', 'desc')->get();

        $pdf = PDF::loadView('backend.credentials.pdf', compact('credentials'));
        return $pdf->download('credentials.pdf');

    }
    
}
