<?php 

function getAddToCartTotalItem()
{
	if(session()->has('FRONT_USER_LOGIN')){
            $uid=session()->get('FRONT_USER_ID');
            $user_type="Reg";
        }
        else{
            $user_type="Not-Reg";
            if(session()->has('USER_TEMP_ID') == NULL){
                $rand= rand(111111111,999999999);
                session()->put('USER_TEMP_ID',$rand);
                $uid = $rand;
            }
            else{
                $uid = session()->get('USER_TEMP_ID');
            }
        }


        $cartResult=DB::table('cart')
                ->leftjoin('products','products.id','=','cart.product_id')
                ->leftjoin('product_attr','product_attr.id','=','cart.product_attr_id')
                ->leftjoin('sizes','sizes.id','=','product_attr.size_id')
                ->leftjoin('colors','colors.id','=','product_attr.color_id')
                ->where(['user_id'=>$uid])
                ->where(['user_type'=>$user_type])
                ->select('cart.qty','products.name','products.image','colors.color','sizes.size','product_attr.price','products.slug','products.id as pid','product_attr.id as attr_id') 
                 // ->select('*')
                ->get();
               return $cartResult;

}


function getUserTempId()
{
    if(!session()->has('USER_TEMP_ID'))
    {
        $rand= rand(111111111,999999999);
        session()->put('USER_TEMP_ID',$rand);
        return $rand;
    }
    else
    {
        $uid = session()->get('USER_TEMP_ID');
        return $uid;
    }
}

function applyCouponCode($coupon_code)
{
    $newAmount= 0;
    $totalCartAmount = 0;
        $result=DB::table('coupons')
                ->where(['code'=>$coupon_code])
                ->get();
                // dd($result);
        if (isset($result[0])) 
        {
            $value = $result[0]->value;
            $type = $result[0]->type;

            if ($result[0]->status == 1) 
            {
                if ($result[0]->is_one_time == 1) 
                {
                    $status = 'error';
                    $msg = 'Coupon Code Already Used';
                }
                else
                {
                    $min_amount = $result[0]->min_order_amount;
                    $getAddToCartTotalItem = getAddToCartTotalItem();
                    // dd($getAddToCartTotalItem);
                    $totalCartAmount = 0;
                    foreach($getAddToCartTotalItem as $list){
                        $totalCartAmount = $totalCartAmount + ($list->qty * $list->price);
                    }

                    if ($min_amount < $totalCartAmount ) {
                        $status = 'success';
                        $msg = 'Coupon Applied';
                    }
                    else{
                        $status = 'error';
                        $msg = "cart amount must be greater then $min_amount";
                    }
                }
                
            }
            else
            {
                $status = 'success';
                $msg = 'This coupon is deactivated';
            }
           
        }
        else
        {
            $status = 'error';
            $msg = 'Please Enter valid Coupon';
        }

        if ($status == 'success') 
        {
            if($type == 'Value')
            {
                $newAmount = $value;
                $totalCartAmount = $totalCartAmount - $newAmount;
            }    
            if($type == 'Per') 
            {
                $newAmount = ($totalCartAmount) * ($value/100);
                $totalCartAmount = $totalCartAmount - $newAmount;
            }
        }

        return json_encode(['status'=>$status,'msg'=>$msg, 'cartTotalAmount'=>round($totalCartAmount) , 'discounted_amount'=>round($newAmount)]);
}

 function getCustomDate($date)
 {
    if ($date != '') {
        $date=strtotime($date);
        return date('M d,Y',$date);
    }
 }

 function getAvailableQty($product_id,$attr_id)
 {
    $orderProductQty=DB::table('oders_detail')
                ->leftjoin('orders','orders.id','=','oders_detail.orders_id')
                ->leftjoin('product_attr','product_attr.id','=','oders_detail.products_attr_id')
                ->where(['oders_detail.product_id'=>$product_id])
                ->where(['oders_detail.products_attr_id'=>$attr_id])
                ->select('oders_detail.qty','product_attr.qty as pqty') 
                ->get();
               return $orderProductQty;
 }