<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HrController extends Controller
{
    public function index()
    {
   $this->authorize('viewAny');

    }
}
