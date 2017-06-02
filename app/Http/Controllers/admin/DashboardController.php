<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

	use UserAdmin;
    
    
    public function __construct()
    {
    	$this->setUser();
    }

    public function index(){

    	return view('back.dashboard');
    }
}