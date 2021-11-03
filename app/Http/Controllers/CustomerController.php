<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Customer::all();
        return view('admin.customer',['customer'=>$result]);
    }

   
    public function show(Request $req, $id = '')
    {
            
        $arr['data'] = Customer::find($id);
        $customer['customer_list'] = $arr['data'] ;
        // dd($customer['customer_list']);
           
        return view('admin.customer_list',$customer);
    }

     public function status(Request $req,$status,$id)
    {

        $size = Customer::find($id);
        $size->status = $status;
        $size->save();
        $req->session()->flash('message','Customer Status Updated');
        return redirect('admin/customer');
    }
}
