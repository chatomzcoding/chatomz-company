<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GadgetController extends Controller
{
    public function index()
    {
        return view('company.gadget.index');
    }
}
