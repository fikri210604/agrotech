<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Company;

class HomeController extends Controller
{
    public function index(){
        $company = Company::first();
        return view("home",compact("company"));
    }
}
