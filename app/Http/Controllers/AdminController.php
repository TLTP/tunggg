<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use app\http\requests;
use Illuminate\support\facades\redirect;
session_start(); 



class AdminController extends Controller
{
   public function index(){
   	return view('admin_login');
   }
   public function show_dashboard(){
   	   	return view('admin.dashboard');
   	   }

   public function dashboard(Request $request)
        {
        	$admin_email = $request->admin_email;
        	$admin_password = $request->admin_password;
        	$result = DB::table('tbl-admin')->where('admin_email',$admin_email)->where('admin_password',md5($admin_password))->first();
  		 	if ($result)
  		 {
  			session::put('admin_name',$result->admin_name);
  			session::put('admin_id',$result->admin_id);
  			return redirect::to('/dashboard');
  		 	}else{
  		session::put('message','Sai tài khoản hoặc mật khẩu, vui lòng nhập lại');
  			return redirect::to('/admin');

  	}
   }
    public function dangxuat()
    {
    		session::put('admin_name',null);
  			session::put('admin_id',null);
  			return redirect::to('admin');
   }
}
