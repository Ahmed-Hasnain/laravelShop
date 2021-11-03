<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
        $result = Coupon::all();
        return view('admin.coupon',['coupon'=>$result]);
    }

   
    public function manage_coupon(Request $req, $id = '')
    {
        if ($id>0) 
        {
            $arr['data'] = Coupon::find($id);

            $coupon['title'] = $arr['data']->title ;
            $coupon['code'] = $arr['data']->code ;
            $coupon['value'] = $arr['data']->value ;
            $coupon['type'] = $arr['data']->type ;
            $coupon['min_order_amount'] = $arr['data']->min_order_amount ;
            $coupon['is_one_time'] = $arr['data']->is_one_time ;
            $coupon['id'] = $arr['data']->id ;
            
        }
        else
        {
            $coupon['title'] = '';
            $coupon['code'] = '';
            $coupon['value'] = '';
            $coupon['type'] ='';
            $coupon['min_order_amount'] = '';
            $coupon['is_one_time'] = '';
            $coupon['id'] = '';
        }
        // echo "<pre>";
        // print_r($category);
        // die();
       
       return view('admin.manage_coupon',$coupon);
    }

    public function manage_coupon_process(Request $req)
    {
        //return $req->post();
        $req->validate([
            'title'=>'required',
            'code'=>'required|unique:coupons,code,'.($req->post('id')),
            'value'=>'required',
        ]);

        if ($req->post('id')>0) 
        {
            $coupon = Coupon::find($req->post('id'));
            $msg = 'Coupon Edited Successfully';
        }
        else
        {
            $coupon = new Coupon;
            $msg = 'Coupon Inserted Successfully';
            $coupon->status = 1;
        }

        
        $coupon->title = $req->post('title');
        $coupon->code = $req->post('code');
        $coupon->value = $req->post('value');
        $coupon->type = $req->post('type');
        $coupon->min_order_amount = $req->post('min_order_amount');
        $coupon->is_one_time = $req->post('is_one_time');
        $coupon->save();
        $req->session()->flash('message',$msg);
        return redirect('admin/coupon');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $req)
    {

        $coupon = Coupon::find($req->id);
        $coupon->delete();
        $req->session()->flash('message','Coupon Deleted');
        return redirect('admin/coupon');
    }

     public function status(Request $req,$status,$id)
    {

        $coupon = Coupon::find($id);
        $coupon->status = $status;
        $coupon->save();
        $req->session()->flash('message','Coupon Status Updated');
        return redirect('admin/coupon');
    }

   
}
