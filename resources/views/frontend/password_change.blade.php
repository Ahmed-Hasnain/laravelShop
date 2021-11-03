@extends('frontend/layout');
@section('page_title','Change Password')
@section('container')


 <!-- Cart view section -->
 <section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area">         
            <div class="row">
              <div class="col-md-6">
                <div class="aa-myaccount-register">                 
                 <h4>Change Password</h4>
                 <form action="" class="aa-login-form" id="frmUpdatePassword">

                    <label for="">Password<span>*</span></label>
                    <input type="password" placeholder="Password" name="password" required>
                    <span id="password_error" class="field_error text-danger"></span><br>

                    <button type="submit" class="aa-browse-btn" id="btnUpdatePassword">Update Password</button>   

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