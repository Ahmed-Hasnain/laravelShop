<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        
        
        if ($request->session()->has('ADMIN_LOGIN')) 
        {
            //dd($request->session()->has('ADMIN_LOGIN'));  
            return redirect('admin/dashboard');
        }
        else
        {
            return view('admin.login');

        }
       
    }
   
    public function auth(Request $req)
    {
        $email = $req->post('email');
        $password = $req->post('password');

        $result = Admin::where(['email'=>$email])->first();
        
        if ($result) 
        {
            if ($req->post('password') == $result->password) 
            {
                $req->session()->put('ADMIN_LOGIN',TRUE);
                $req->session()->put('ADMIN_ID',$result->id);
                return redirect('admin/dashboard');
            }
            else
            {
                $req->session()->flash('error','please enter correct password');
                 return redirect('admin');
            }
            
        }
        else
        {
            $req->session()->flash('error','user not found.');
            return redirect('admin');
        }
    }

    public function dashboard()
    {
        //
        return view('admin.dashboard');
    }

    
}
