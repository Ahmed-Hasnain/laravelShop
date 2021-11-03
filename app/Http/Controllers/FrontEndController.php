<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\validator;
use Crypt;
use Mail;


class FrontEndController extends Controller
{
    //
    public function index(Request $req)
    {

        //Getting is_home categories from db
        $result['home_categories'] = DB::table('categories')
                                    ->where(['status'=>1])
                                    ->where(['is_home'=>1])
                                    ->get();

         
        //Getting products of is_home categories from db                             
        foreach($result['home_categories'] as $list)
        {
            $result['home_categories_product'][$list->id]=
                DB::table('products')
                ->where(['status'=>1])
                ->where(['category_id'=>$list->id])
                ->get();

                //Getting products_attr of products of is_home categories from db 
                foreach($result['home_categories_product'][$list->id] as $list1)
                {   
             
                    $result['home_product_attr'][$list1->id]=
                        DB::table('product_attr')
                        ->leftjoin('sizes','sizes.id','=','product_attr.size_id')
                        ->leftjoin('colors','colors.id','=','product_attr.color_id')
                        ->where(['product_attr.product_id'=>$list1->id])
                        ->get();
                }
        }

        //Getting brands for home page from db
        $result['home_brands'] = DB::table('brands')
                                    ->where(['status'=>1])
                                    ->get();


        //Getting featured products for home page from db                           
        $result['home_featured_product'][$list->id]=
                DB::table('products')
                ->where(['status'=>1])
                ->where(['is_featured'=>1])
                ->get();

                //Getting products_attr of featured products from db 
                foreach($result['home_featured_product'][$list->id] as $list1)
                {   
             
                    $result['home_featured_product_attr'][$list1->id]=
                        DB::table('product_attr')
                        ->leftjoin('sizes','sizes.id','=','product_attr.size_id')
                        ->leftjoin('colors','colors.id','=','product_attr.color_id')
                        ->where(['product_attr.product_id'=>$list1->id])
                        ->get();
                }



        //Getting Promo products for home page from db                           
        $result['home_promo_product'][$list->id]=
                DB::table('products')
                ->where(['status'=>1])
                ->where(['is_promo'=>1])
                ->get();

                //Getting products_attr of promo products from db 
                foreach($result['home_promo_product'][$list->id] as $list1)
                {   
             
                    $result['home_promo_product_attr'][$list1->id]=
                        DB::table('product_attr')
                        ->leftjoin('sizes','sizes.id','=','product_attr.size_id')
                        ->leftjoin('colors','colors.id','=','product_attr.color_id')
                        ->where(['product_attr.product_id'=>$list1->id])
                        ->get();
                } 




        //Getting discounted products for home page from db                           
        $result['home_discounted_product'][$list->id]=
                DB::table('products')
                ->where(['status'=>1])
                ->where(['is_discounted'=>1])
                ->get();

                //Getting products_attr of discounted products from db 
                foreach($result['home_discounted_product'][$list->id] as $list1)
                {   
             
                    $result['home_discounted_product_attr'][$list1->id]=
                        DB::table('product_attr')
                        ->leftjoin('sizes','sizes.id','=','product_attr.size_id')
                        ->leftjoin('colors','colors.id','=','product_attr.color_id')
                        ->where(['product_attr.product_id'=>$list1->id])
                        ->get();
                }   


        //Getting Home Banner data from db
        $result['home_banners'] = DB::table('home_banners')
                                    ->where(['status'=>1])
                                    ->get();
  

         // dd($result);                             
        return view('frontend.index',$result);
    }


    public function product(Request $req,$slug)
    {
        $result['product']=DB::table('products')
                            ->where(['status'=>1])
                            ->where(['slug'=>$slug])
                            ->get();

                //Getting products_attr of single product from db 
                foreach($result['product'] as $list1)
                {   
             
                    $result['product_attr']=
                        DB::table('product_attr')
                        ->leftjoin('sizes','sizes.id','=','product_attr.size_id')
                        ->leftjoin('colors','colors.id','=','product_attr.color_id')
                        ->where(['product_attr.product_id'=>$list1->id])
                        ->get();
                }   


                //Getting products images of single product from db 
                foreach($result['product'] as $list2)
                {   
             
                    $result['product_images'][$list2->id]=
                        DB::table('product_images')
                        ->where(['product_images.product_id'=>$list2->id])
                        ->get();
                }   

                //Getting related products of single product from db 
        $result['related_products']=DB::table('products')
                            ->where(['status'=>1])
                            ->where('slug','!=',$slug)
                            ->where(['category_id'=>$result['product'][0]->category_id])
                            ->get();

                //Getting products_attr of discounted products from db 
                foreach($result['related_products'] as $list3)
                {   
             
                    $result['related_product_attr'][$list3->id]=
                        DB::table('product_attr')
                        ->leftjoin('sizes','sizes.id','=','product_attr.size_id')
                        ->leftjoin('colors','colors.id','=','product_attr.color_id')
                        ->where(['product_attr.product_id'=>$list3->id])
                        ->get();
                }  

                $result['product_reviews']=
                        DB::table('product_review')
                        ->leftjoin('customers','customers.id','=','product_review.customer_id')
                        ->where(['product_review.product_id'=>$result['product'][0]->id])
                        ->where(['product_review.status'=> 1] )
                        ->orderBy('product_review.added_on','desc')
                        ->get();

               //  echo "<pre>";
               // print_r($result);
               // die();

        return view('frontend.product',$result);
        
    }

    // Add to cart code
    public function add_to_cart(Request $req)
    {
        if($req->session()->has('FRONT_USER_LOGIN')){
            $uid=$req->session()->get('FRONT_USER_ID');
            $user_type="Reg";
        }
        else{
            $user_type="Not-Reg";
            $uid = getUserTempId();
        }

        $size_id = $req->post('size_id');
        $color_id = $req->post('color_id');
        $pqty = $req->post('pqty');
        $product_id = $req->post('product_id');

        $result=DB::table('product_attr')
                            ->select('product_attr.id')
                            ->leftjoin('sizes','sizes.id','=','product_attr.size_id')
                            ->leftjoin('colors','colors.id','=','product_attr.color_id')
                            ->where(['product_id'=>$product_id])
                            ->where(['sizes.size'=>$size_id])
                            ->where(['colors.color'=>$color_id])
                            ->get();

        $product_attr_id = $result[0]->id;

        $getAvailableQty = getAvailableQty($product_id,$product_attr_id);
        

        
        $check=DB::table('cart')
                ->where(['user_id'=>$uid])
                ->where(['product_id'=>$product_id])
                ->where(['user_type'=>$user_type])
                ->where(['product_attr_id'=>$product_attr_id])
                ->get();

        if(isset($check[0])){
            $update_id = $check[0]->id; 
            if($pqty == 0){
                DB::table('cart')
                ->where(['id'=>$update_id])
                ->delete();
                $msg = "Product Deleted";
            }else{
                DB::table('cart')
                ->where(['id'=>$update_id])
                ->update(['qty'=>$pqty]);
                $msg = "Cart Updated";
            }
                
        }
        else
        {
            $id=DB::table('cart')->insertGetId([
                'user_id'=>$uid,
                'product_id'=>$product_id,
                'user_type'=>$user_type,
                'product_attr_id'=>$product_attr_id,
                'qty'=>$pqty,
                'added_on'=>date('Y-m-d h:i:s')
            ]);
            $msg = "Products Added in Cart";
        }

        $result=DB::table('cart')
                ->leftjoin('products','products.id','=','cart.product_id')
                ->leftjoin('product_attr','product_attr.id','=','cart.product_attr_id')
                ->leftjoin('sizes','sizes.id','=','product_attr.size_id')
                ->leftjoin('colors','colors.id','=','product_attr.color_id')
                ->where(['user_id'=>$uid])
                ->where(['user_type'=>$user_type])
                ->select('cart.qty','products.name','products.image','colors.color','sizes.size','product_attr.price','products.slug','products.id as pid','product_attr.id as attr_id') 
                 // ->select('*')
                ->get();

        return response()->json(['msg'=>$msg , 'data'=>$result , 'totalCartItem'=>count($result)]);
    }


    public function cart(Request $req)
    {
        if($req->session()->has('FRONT_USER_LOGIN')){
            $uid=$req->session()->get('FRONT_USER_ID');
            $user_type="Reg";
        }
        else{
            $user_type="Not-Reg";
            $uid = getUserTempId();
            
        }


        $result['list']=DB::table('cart')
                ->leftjoin('products','products.id','=','cart.product_id')
                ->leftjoin('product_attr','product_attr.id','=','cart.product_attr_id')
                ->leftjoin('sizes','sizes.id','=','product_attr.size_id')
                ->leftjoin('colors','colors.id','=','product_attr.color_id')
                ->where(['user_id'=>$uid])
                ->where(['user_type'=>$user_type])
                ->select('cart.qty','products.name','products.image','colors.color','sizes.size','product_attr.price','products.slug','products.id as pid','product_attr.id as attr_id') 
                 // ->select('*')
                ->get();

                // dd($result);

        return view('frontend.cart',$result);
    }


    public function category(Request $req,$slug)
    {

        // Category filters
        $sort = "";
        $sort_text = "";
        $filter_price_start = "";
        $filter_price_end = "";
        $color_filter = "";
        $colorFilterArr = [];

        if ($req->get('sort') != null) 
        {
            $sort = $req->get('sort');
        }  
        //to get the filtered products                   
        $query=DB::table('products');
        $query=$query->leftjoin('categories','categories.id','=','products.category_id');
        $query=$query->leftjoin('product_attr','product_attr.product_id','=','products.id');        
        $query=$query->where(['products.status'=>1]);
        $query=$query->where(['categories.category_slug'=>$slug]);
        if($sort == 'name'){
            $query=$query->orderBy('products.name','asc');
            $sort_text = 'Sorted By Name';
        }
        if($sort == 'date'){
            $query=$query->orderBy('products.id','desc');
            $sort_text = 'Sorted By Date';
        }
        if($sort == 'price_desc'){
            $query=$query->orderBy('product_attr.price','desc');
            $sort_text = 'Sorted By Price Decending';
        }
        if($sort == 'price_asc'){
            $query=$query->orderBy('product_attr.price','asc');
            $sort_text = 'Sorted By Price Ascending';
        }
        if ($req->get('filter_price_start') != null && $req->get('filter_price_end') != null) 
        {
            $filter_price_start = $req->get('filter_price_start');
            $filter_price_end = $req->get('filter_price_end');
            if (($filter_price_start>0) && ($filter_price_end>0)) {
                $query=$query->whereBetween('product_attr.price',[$filter_price_start,$filter_price_end]);
            }
        }
        if($req->get('color-filter') != null){
            $color_filter = $req->get('color-filter'); 
            $colorFilterArr = explode(':',$color_filter);
            $colorFilterArr = array_filter($colorFilterArr);

            $query=$query->where(['product_attr.color_id'=>$req->get('color-filter')]);
        }

        $query=$query->distinct()->select('products.id','products.slug','products.image','products.name');
        $query=$query->get();

        $result['product']= $query;

        //to get the attributes of the filtered products
                foreach($result['product'] as $list4)
                {   
                    $query=DB::table('product_attr');
                    $query=$query->leftjoin('sizes','sizes.id','=','product_attr.size_id');
                    $query=$query->leftjoin('colors','colors.id','=','product_attr.color_id');
                    $query=$query->where(['product_attr.product_id'=>$list4->id]);
                    $query=$query->get();
                    $result['product_attr'][$list4->id]= $query;
                }   


        //To get the colors of all the products exixting in the DB        
        $result['colors']=DB::table('colors')
                            ->where(['status'=>1])
                            ->get();


        //Getting is_home categories from db
        $result['sidebar_categories'] = DB::table('categories')
                                    ->where(['status'=>1])
                                    ->get();




                $result['slug']=$slug;
                $result['sort']=$sort;
                $result['sort_text']=$sort_text;
                $result['filter_price_start']=$filter_price_start;
                $result['filter_price_end']=$filter_price_end;
                $result['color_filter']=$color_filter;
                $result['colorFilterArr']=$colorFilterArr;
                
                // echo "<pre>";
                // print_r($result['colors']);
                // die();

        return view('frontend.category',$result);
    }


     public function search(Request $req,$str)
    {
        $query=DB::table('products');
        $query=$query->leftjoin('categories','categories.id','=','products.category_id');
        $query=$query->leftjoin('product_attr','product_attr.product_id','=','products.id');        
        $query=$query->where(['products.status'=>1]);
        $query=$query->where('name','like',"%$str%");
        $query=$query->orwhere('model','like',"%$str%");
        $query=$query->orwhere('short_desc','like',"%$str%");
        $query=$query->orwhere('desc','like',"%$str%");
        $query=$query->orwhere('keywords','like',"%$str%");
        $query=$query->distinct()->select('products.id','products.slug','products.image','products.name');
        $query=$query->get();

        $result['product']= $query;

        //to get the attributes of the filtered products
                foreach($result['product'] as $list4)
                {   
                    $query=DB::table('product_attr');
                    $query=$query->leftjoin('sizes','sizes.id','=','product_attr.size_id');
                    $query=$query->leftjoin('colors','colors.id','=','product_attr.color_id');
                    $query=$query->where(['product_attr.product_id'=>$list4->id]);
                    $query=$query->get();
                    $result['product_attr'][$list4->id]= $query;
                }   

               // echo "<pre>";
               // print_r($result);
               // die();

        return view('frontend.search',$result);
        
    }

      public function registration(Request $req)
    {
        if($req->session()->has('FRONT_USER_LOGIN') != null){
             return redirect('/');
        }

        $result = [];
        return view('frontend.registration',$result);
    }

    public function registration_process(Request $request)
    {
        $valid = validator::make($request->all(),[
            "name"=>'required',
            "email"=>'required|email|unique:customers,email',
            "password"=>'required',
            "mobile"=>'required|numeric|digits:10'
        ]);

        if (!$valid->passes()) {
            return response()->json(['status'=>'error','error'=>$valid->errors()->toArray()]);
        }
        else{
            $rand_id=rand(111111111,999999999);
            $arr=[
                "name"=>$request->name,
                "email"=>$request->email,
                "password"=>Crypt::encrypt($request->password),
                "mobile"=>$request->mobile,
                "status"=>1,
                "is_varify"=>0,
                "rand_id"=>$rand_id,
                "created_at"=>date('Y-m-d h:i:s'),
                "updated_at"=>date('Y-m-d h:i:s')
            ];

            $query = DB::table('customers')->insert($arr);
            if ($query) {
                $data=['name'=>$request->name ,'rand_id'=>$rand_id ];
                $user['to']=$request->email ;
                Mail::send('frontend/email_verification',$data,function($messages) use ($user){
                        $messages->to($user['to']);
                        $messages->subject('Email ID Verification');
                });

            return response()->json(['status'=>'success','msg'=>"Registration Successful. Please check your inbox for email varification"]);
            }
        }
    }

     public function login_process(Request $request)
    {
       
        $result=DB::table('customers')
                ->where(['email'=>$request->login_email])
                ->get();

        if (isset($result[0])) 
        {
            $user_pass = Crypt::decrypt($result[0]->password);
            $status = $result[0]->status;
            $is_verify = $result[0]->is_varify;

            if ($is_verify == 0) {
                return response()->json(['status'=>'error','msg'=>'Please Verify Your Email']);
            }

            if ($status == 0) {
                return response()->json(['status'=>'error','msg'=>'Your account has been deactivated']);
            }

            if ($user_pass == $request->login_password ) 
            {
                if ($request->rememberme === null) {
                    setcookie('login_email',$request->login_email,100);
                    setcookie('login_pwd',$request->login_password,100);
                }
                else{
                    setcookie('login_email',$request->login_email,time()+60*60*24*100);
                    setcookie('login_pwd',$request->login_password,time()+60*60*24*100);
                }

                $request->session()->put('FRONT_USER_LOGIN',true);
                $request->session()->put('FRONT_USER_ID',$result[0]->id);
                $request->session()->put('FRONT_USER_NAME',$result[0]->name);
                $status = 'success';
                $msg = '';

                $getUserTempId = getUserTempId();
                $result=DB::table('cart')
                ->where(['user_id'=>$getUserTempId,'user_type'=>'Not-Reg'])
                ->update(
                    [
                        'user_id'=>$result[0]->id,
                        'user_type'=>'Reg'
                    ]

                );




            }
            else
            {
                $status = 'error';
                $msg = 'Please Enter Correct Password'; 
            }
              
        }
        else
        {
            $status = 'error';
            $msg = 'Please Enter valid Email ID';
        }

        return response()->json(['status'=>$status,'msg'=>$msg]);
    }

    public function email_verification(Request $req,$id)
    {

         $result=DB::table('customers')
                ->where(['rand_id'=>$id])
                ->where(['is_varify'=>0])
                ->get();

         if (isset($result[0])) 
         {
            $result=DB::table('customers')
                ->where(['id'=>$result[0]->id])
                ->update(['is_varify'=>1,'rand_id'=>'']);
                return view('frontend.verification');
         }
         else
         {
            return redirect('/');
         }
    }

    public function forgot_password(Request $request)
    {
        $rand_id=rand(111111111,999999999);
         $result1=DB::table('customers')
                ->where(['email'=>$request->forgot_email])
                ->get();

        if (isset($result1[0])) 
        {

            $result=DB::table('customers')
                ->where(['email'=>$request->forgot_email])
                ->update(['is_forgot_password'=>1,'rand_id'=>$rand_id]);
                 
            $data=['name'=>$result1[0]->name ,'rand_id'=>$rand_id ];

            $user['to']=$request->forgot_email ;
            Mail::send('frontend/forgot_password',$data,function($messages) use ($user){
                    $messages->to($user['to']);
                    $messages->subject('Forgot Password');
            });

            return response()->json(['status'=>'success','msg'=>'Please check your email id to change the password.']);
        }
        else
        {
            return response()->json(['status'=>'error','msg'=>'This Email Is Not Registered']);
        }
    }



    public function password_change(Request $req,$id)
    {

         $result=DB::table('customers')
                ->where(['rand_id'=>$id])
                ->where(['is_forgot_password'=>1])
                ->get();

         if (isset($result[0])) 
         {
            $req->session()->put('FORGOT_PASSWORD_USER_ID',$result[0]->id);
            return view('frontend.password_change');
         }
         else
         {
            return redirect('/');
         }
    }
    

    public function forgot_password_change_process(Request $request)
    {
        $result=DB::table('customers')
                ->where(['id'=>$request->session()->get('FORGOT_PASSWORD_USER_ID')])
                ->update(
                    [
                        'is_forgot_password'=>0,
                        'password'=>Crypt::encrypt($request->password),
                        'rand_id'=>''

                    ]

                );

        return response()->json(['status'=>'success','msg'=>'Password Changed Successfully']);

    }


    public function checkout(Request $req)
    {
        $result['cart_data'] = getAddToCartTotalItem();
        // dd($result);
        if (isset($result['cart_data'][0])) 
         {
            if($req->session()->has('FRONT_USER_LOGIN')){
            $uid=$req->session()->get('FRONT_USER_ID');
            $customer_info = DB::table('customers')
                            ->where(['id'=>$uid])
                            ->get();
            $result['customer']['name']=$customer_info[0]->name;
            $result['customer']['email']=$customer_info[0]->email;
            $result['customer']['mobile']=$customer_info[0]->mobile;
            $result['customer']['address']=$customer_info[0]->address;
            $result['customer']['city']=$customer_info[0]->city;
            $result['customer']['state']=$customer_info[0]->state;
            $result['customer']['company']=$customer_info[0]->company;
            $result['customer']['zip']=$customer_info[0]->zip;
            $result['customer']['gstin']=$customer_info[0]->gstin;
        }
        else{
          $result['customer']['name']='';
            $result['customer']['email']='';
            $result['customer']['mobile']='';
            $result['customer']['address']='';
            $result['customer']['city']='';
            $result['customer']['state']='';
            $result['customer']['company']='';
            $result['customer']['zip']='';
            $result['customer']['gstin']='';
        }
            return view('frontend.checkout',$result);
         }
         else
         {
            return redirect('/');
         }

    }
    
     public function apply_coupon_code(Request $request)
    {

        $arr = applyCouponCode($request->coupon_code);
        $arr = json_decode($arr,true);
        //dd($arr);
        return response()->json(['status'=>$arr['status'],'msg'=>$arr['msg'], 'cartTotalAmount'=>round($arr['cartTotalAmount']) , 'discounted_amount'=>round($arr['discounted_amount'])]);
    }



    public function remove_coupon(Request $request)
    {
       $totalCartAmount = 0;
        $result=DB::table('coupons')
                ->where(['code'=>$request->coupon_code])
                ->get();
      
        $getAddToCartTotalItem = getAddToCartTotalItem();
        // dd($getAddToCartTotalItem);
        $totalCartAmount = 0;
        foreach($getAddToCartTotalItem as $list){
            $totalCartAmount = $totalCartAmount + ($list->qty * $list->price);
        }
        

        return response()->json(['status'=>'success', 'cartTotalAmount'=>round($totalCartAmount) ]);
    }


    public function place_order(Request $req)
    {
        // dd($_POST);
        $payment_url = '';
        $coupon_value = 0;
        $rand_id=rand(111111111,999999999);
        if($req->session()->has('FRONT_USER_LOGIN'))
        {
            
        }
        else
        {
            $valid = validator::make($req->all(),[

            "email"=>'required|email|unique:customers,email'

        ]);

            if (!$valid->passes()) 
            {
                return response()->json(['status'=>'error','msg'=>'The email has already been taken']);
            }
            else
            {
                
                $arr=[
                    "name"=>$req->name,
                    "email"=>$req->email,
                    "address"=>$req->address,
                    "city"=>$req->city,
                    "state"=>$req->district,
                    "zip"=>$req->zip,
                    "password"=>Crypt::encrypt($rand_id),
                    "mobile"=>$req->mobile,
                    "status"=>1,
                    "is_varify"=>1,
                    "rand_id"=>$rand_id,
                    "created_at"=>date('Y-m-d h:i:s'),
                    "updated_at"=>date('Y-m-d h:i:s'),
                    "is_forgot_password"=>0
                ];

            $user_id = DB::table('customers')->insertGetId($arr);
            $req->session()->put('FRONT_USER_LOGIN',true);
            $req->session()->put('FRONT_USER_ID',$user_id);
            $req->session()->put('FRONT_USER_NAME',$req->name);
            //sent mail to new user with his password
            $data=['name'=>$req->name ,'password'=>$rand_id ];
            $user['to']=$req->email ;
            Mail::send('frontend/password_sent',$data,function($messages) use ($user){
                    $messages->to($user['to']);
                    $messages->subject('New Password');
            });

            $getUserTempId = getUserTempId();
                $result=DB::table('cart')
                ->where(['user_id'=>$getUserTempId,'user_type'=>'Not-Reg'])
                ->update(
                    [
                        'user_id'=>$user_id,
                        'user_type'=>'Reg'
                    ]

                );
            
            }
        }

        if ($req->coupon_code != '') 
            {
                $arr = applyCouponCode($req->coupon_code);
                $arr = json_decode($arr,true);
                $coupon_value = $arr['discounted_amount'];
                if ($arr['status'] == 'success') 
                {
                    
                }
                else
                {
                    return response()->json(['status'=>$arr['status'],'msg'=>$arr['msg']]);
                }
            }
            

            $uid=$req->session()->get('FRONT_USER_ID');
            $name=$req->name;
            $company_name=$req->company_name;
            $email=$req->email;
            $mobile=$req->mobile;
            $address=$req->address;
            $city=$req->city;
            $district=$req->district;
            $zip=$req->zip;
            $coupon_code=$req->coupon_code;
            $payment_type=$req->payment_type;
            //////////////////////////////////////////////
            //Total Cart Amount
            $totalCartAmount = 0;
            $getAddToCartTotalItem = getAddToCartTotalItem();      
            foreach($getAddToCartTotalItem as $list)
            {
                $totalCartAmount = $totalCartAmount + ($list->qty * $list->price);
            }
            /////////////////////////////////////////////////
            $arr=[
                "customer_id"=>$uid,
                "name"=>$name,
                "email"=>$email,
                "mobile"=>$mobile,
                "address"=>$address,
                "city"=>$city,
                "state"=>$district,
                "pincode"=>$zip,
                "coupon_code"=>$coupon_code,
                "coupon_value"=>$coupon_value,
                "order_status"=>1,
                "payment_type"=>$payment_type,
                "payment_status"=>"Pending",
                "payment_id"=>'',
                "total_amount"=>$totalCartAmount,
                "added_on"=>date('Y-m-d h:i:s')
            ];

            $order_id = DB::table('orders')->insertGetId($arr);

            if ($order_id > 0) 
            {
               foreach($getAddToCartTotalItem as $list)
                    {      
                        $productDetailArr['product_id']= $list->pid;
                        $productDetailArr['products_attr_id']= $list->attr_id;
                        $productDetailArr['price']= $list->price;
                        $productDetailArr['qty']= $list->qty;
                        $productDetailArr['orders_id']= $order_id ;
                        DB::table('oders_detail')->insert($productDetailArr);
                    }

                    // Code for paypal payment gateway
                    if ($payment_type == 'paypal') 
                    {
                        echo "hello";
                    }

                DB::table('cart')
                ->where(['user_id'=>$uid , 'user_type'=>'Reg' ])
                ->delete();
                $req->session()->put('ORDER_ID',$order_id); 

                $status = "success";
                $msg = "Order placed.";
            }
            else
            {
                $status = "error";
                $msg = "Please Try After Sometime.";
            }

    
        return response()->json(['status'=>$status,'msg'=>$msg,'payment_url'=>$payment_url]);
    
    }


     public function order_placed(Request $req)
    {
        $result = [];
        if($req->session()->has('ORDER_ID')){
            return view('frontend.order_placed',$result);
        }
        else{
            return redirect('/');
        }
    }

    public function order(Request $req)
    {
        $result['order']=DB::table('orders')
                            ->select('orders.*','orders_status.order_status')
                            ->leftjoin('orders_status','orders_status.id','=','orders.order_status')
                            ->where(['orders.customer_id'=>$req->session()->get('FRONT_USER_ID')])
                            ->get();
        // dd($result);
        return view('frontend.order',$result); 
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
                            ->where(['orders.customer_id'=>$req->session()->get('FRONT_USER_ID')])
                            ->get();
                             //dd($result);

        if (!isset($result['product_detail'][0])) {
            return redirect('/');
        }
                           
        return view('frontend.order_detail',$result); 
    }



     public function product_review_process(Request $request)
    {
        if($request->session()->has('FRONT_USER_LOGIN')){
            $uid=$request->session()->get('FRONT_USER_ID');
            $arr=[
                    "rating"=>$request->rating,
                    "review"=>$request->review,
                    "product_id"=>$request->product_id,
                    "customer_id"=>$uid,
                    "status"=>1,                
                    "added_on"=>date('Y-m-d h:i:s'),
                    
                ];
            $query = DB::table('product_review')->insert($arr);
            $status = 'success';
            $msg = 'Review Submited Successfully. Thank you!';
        }
        else{
            $status = 'error';
            $msg = 'Please login to submit review';
        }  

        return response()->json(['status'=>$status, 'msg'=>$msg ]);
    }

}


