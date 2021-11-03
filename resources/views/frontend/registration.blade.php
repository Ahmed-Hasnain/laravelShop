@extends('frontend/layout');
@section('page_title','Registration')
@section('container')

{{-- @php

              echo "<pre>";
               // print_r($result['product_images']);
               print_r($product_attr[0]);
               die();

@endphp --}}

<!-- catg header banner section -->
  <section id="aa-catg-head-banner">
    <img src="{{asset('front_assets/img/fashion/fashion-header-bg-8.jpg')}}" alt="fashion img">
    <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Account Page</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>                   
          <li class="active">Account</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

 <!-- Cart view section -->
 <section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area">         
            <div class="row">
              <div class="col-md-6">
                <div class="aa-myaccount-register">                 
                 <h4>Register</h4>
                 <form action="" class="aa-login-form" id="frmRegistration">
                    <label for="">Username <span>*</span></label>
                    <input type="text" placeholder="Username" name="name" >
                    <span id="name_error" class="field_error text-danger"></span><br>

                    <label for="">Email address<span>*</span></label>
                    <input type="email" placeholder="enter email" name="email" >
                    <span id="email_error" class="field_error text-danger"></span><br>

                    <label for="">Mobile Number<span>*</span></label>
                    <input type="text" placeholder="enter mobile no" name="mobile" >
                    <span id="mobile_error" class="field_error text-danger"></span><br>

                    <label for="">Password<span>*</span></label>
                    <input type="password" placeholder="Password" name="password" >
                    <span id="password_error" class="field_error text-danger"></span><br>

                    <button type="submit" class="aa-browse-btn" id="btnRegistration">Register</button>   

                    @csrf

                  </form>
                </div>
                <div id="register_success_msg" >
                  
                </div>
              </div>
            </div>          
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->

@endsection