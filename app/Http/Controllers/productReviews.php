<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class productReviews extends Controller
{
    public function index(Request $request)
    {
        $result['product_reviews']=
            DB::table('product_review')
            ->leftjoin('customers','customers.id','=','product_review.customer_id')
            ->leftjoin('products','products.id','=','product_review.product_id')
            // ->where(['product_review.status'=> 1] )
            ->orderBy('product_review.added_on','desc')
            ->select('product_review.id','product_review.rating','product_review.review','product_review.added_on','product_review.status','products.name as pname','customers.name')
            ->get();
             //dd($result);
            return view('admin.product_review',$result);
    }

         public function update_product_review_status(Request $req,$status,$id)
    {
         DB::table('product_review')
        ->where(['id'=>$id])
        ->update(['status'=>$status]);
        return redirect('/admin/product_reviews');
    }
}
