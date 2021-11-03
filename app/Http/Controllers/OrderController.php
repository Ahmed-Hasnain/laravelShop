<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{
    public function index(Request $req)
    {
         $result['order']=DB::table('orders')
                            ->select('orders.*','orders_status.order_status')
                            ->leftjoin('orders_status','orders_status.id','=','orders.order_status')
                            ->get();
         //dd($result);
         return view('admin.order',$result);
    }

    public function order_detail(Request $req,$id)
    {
        $result['product_detail']=DB::table('oders_detail')
                            ->select('orders.*','oders_detail.price','oders_detail.qty', 'products.name','product_attr.attr_image','sizes.size','colors.color','orders_status.order_status')
                            ->leftjoin('orders','orders.id','=','oders_detail.orders_id')
                            ->leftjoin('product_attr','product_attr.id','=','oders_detail.products_attr_id')
                            ->leftjoin('products','products.id','=','product_attr.product_id')
                            ->leftjoin('sizes','sizes.id','=','product_attr.size_id')
                            ->leftjoin('colors','colors.id','=','product_attr.color_id')
                            ->leftjoin('orders_status','orders_status.id','=','orders.order_status')
                            ->where(['orders.id'=>$id])
                            ->get();
                            // dd($result);

        $result['order_status']=DB::table('orders_status')
                                 ->get();


        $result['payment_status']= ['Pending','Success','Fail'];
                           
        return view('admin.order_detail',$result); 
    }


        public function update_payment_status(Request $req,$status,$id)
    {
         DB::table('orders')
        ->where(['id'=>$id])
        ->update(['payment_status'=>$status]);
        return redirect('/admin/order_detail/'.$id);
    }

         public function update_order_status(Request $req,$status,$id)
    {
         DB::table('orders')
        ->where(['id'=>$id])
        ->update(['order_status'=>$status]);
        return redirect('/admin/order_detail/'.$id);
    }


         public function update_track_status(Request $req,$id)
    {
         $track_details = $req->post('track_detail');
         DB::table('orders')
        ->where(['id'=>$id])
        ->update(['track_details'=>$track_details]);
        return redirect('/admin/order_detail/'.$id);
    }


    
}
