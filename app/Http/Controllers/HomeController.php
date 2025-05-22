<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index(){
        $company = Company::first();
        $products = Product::all();
        $categories = Category::all();
        return view("home",compact("company","products","categories"));
    }
}
