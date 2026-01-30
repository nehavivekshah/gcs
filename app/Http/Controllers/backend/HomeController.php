<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\UserType;
use App\Models\FinancialYear;
use App\Models\UserCredential;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    function login(){

       $userType = UserType::select('id','user_type')->get();
       $allYears = FinancialYear::select('id','financial_year')->get();
       return view('backend/login', compact('userType','allYears'));
    }

    function userCheck(Request $req){

      $username = $req->username;
      $password = $req->password;
      $user_type = $req->user_type;
      $financial_year = $req->financial_year;

      $where = ['user_name' => $username, 'password' => $password, 'user_type' => $user_type];

      $user = UserCredential::where($where)->first();

      if ($user) {
        // Creating the session
        Session::put('user_id', $user->id);  // Save user id to session
        Session::put('user_name', $user->user_name);  // Save user name to session
        Session::put('user_type', $user->user_type);  // Save user type to session
        Session::put('financial_year', $financial_year);  // Save financial year to session

        // Redirecting to the dashboard
        return redirect()->route('admin.dashboard');  // Adjust 'dashboard' to your actual route name
    } else {
        // Redirecting back with an error message if credentials are incorrect
        return redirect()->back()->with('error', 'Invalid login details.');  // The error message to be displayed
    }

    }

    function dashboard(){

       return view('backend/dashboard');
    }

    function logout(){

      Session::flush();

      return redirect()->route('admin.login');
    }

}
