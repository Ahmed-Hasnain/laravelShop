@extends('frontend/layout');
@section('page_title','Checkout Page')
@section('container')


  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <img src="{{asset('front_assets/img/fashion/fashion-header-bg-8.jpg')}}" alt="fashion img">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Checkout Page</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>                   
          <li class="active">Cart</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

   <!-- Cart view section -->
   <section id="checkout">
     <div class="container">
       <div class="row">
         <div class="col-md-12">
          <div class="checkout-area">
            <form id="frmPlaceOrder">
              <div class="row">
                <div class="col-md-8">
                  <div class="checkout-left">
                    <div class="panel-group" id="accordion">

                       <!-- Billing Details -->
                      <div class="panel panel-default aa-checkout-billaddress">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                              Billing Details
                            </a>
                          </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in">
                          <div class="panel-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="aa-checkout-single-bill">
                                  <input type="text" placeholder="Name*" value="{{ $customer['name'] }}" name="name">
                                </div>                             
                              </div>
                              
                            </div> 
                            <div class="row">
                              <div class="col-md-12">
                                <div class="aa-checkout-single-bill">
                                  <input type="text" placeholder="Company name" value="{{ $customer['company'] }}" name="company_name">
                                </div>                             
                              </div>                            
                            </div>  
                            <div class="row">
                              <div class="col-md-6">
                                <div class="aa-checkout-single-bill">
                                  <input type="email" placeholder="Email Address*" value="{{ $customer['email'] }}" name="email">
                                </div>                             
                              </div>
                              <div class="col-md-6">
                                <div class="aa-checkout-single-bill">
                                  <input type="tel" placeholder="Phone*" value="{{ $customer['mobile'] }}" name="mobile"> 
                                </div>
                              </div>
                            </div> 
                            <div class="row">
                              <div class="col-md-12">
                                <div class="aa-checkout-single-bill">
                                  <textarea cols="8" rows="3" name="address">{{ $customer['address'] }} </textarea>
                                </div>                             
                              </div>                            
                            </div>   
                            <div class="row">
                              <div class="col-md-12">
                                <div class="aa-checkout-single-bill" name="country">
                                  <select>
                                    <option value="0">Select Your Country</option>
                                    <option value="1">Australia</option>
                                    <option value="2">Afganistan</option>
                                    <option value="3">Bangladesh</option>
                                    <option value="4">Belgium</option>
                                    <option value="5">Brazil</option>
                                    <option value="6">Canada</option>
                                    <option value="7">China</option>
                                    <option value="8">Denmark</option>
                                    <option value="9">Egypt</option>
                                    <option value="10">India</option>
                                    <option value="11">Iran</option>
                                    <option value="12">Israel</option>
                                    <option value="13">Mexico</option>
                                    <option value="14">UAE</option>
                                    <option value="15">UK</option>
                                    <option value="16">USA</option>
                                    <option value="17">Pakistan</option>
                                  </select>
                                </div>                             
                              </div>                            
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="aa-checkout-single-bill">
                                  <input type="text" placeholder="Appartment, Suite etc." name="Appartment">
                                </div>                             
                              </div>
                              <div class="col-md-6">
                                <div class="aa-checkout-single-bill">
                                  <input type="text" placeholder="City / Town*" value="{{ $customer['city'] }}" name="city">
                                </div>
                              </div>
                            </div>   
                            <div class="row">
                              <div class="col-md-6">
                                <div class="aa-checkout-single-bill">
                                  <input type="text" placeholder="District*" value="{{ $customer['state'] }}" name="district">
                                </div>                             
                              </div>
                              <div class="col-md-6">
                                <div class="aa-checkout-single-bill">
                                  <input type="text" placeholder="Postcode / ZIP*" value="{{ $customer['zip'] }}" name="zip">
                                </div>
                              </div>
                            </div>                                    
                          </div>
                        </div>
                      </div>

                      <!-- Coupon section -->
                      <div class="panel panel-default aa-checkout-coupon coupon_code_box">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                              Have a Coupon?
                            </a>
                          </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                          <div class="panel-body">
                            <input type="text" placeholder="Coupon Code" class="aa-coupon-code" name="coupon_code" id="coupon_code">
                            <input type="button" value="Apply Coupon" class="aa-browse-btn" onclick="applyCouponCode()">
                            <div id="coupon_code_msg"></div>
                          </div>

                        </div>
                      </div>

                      @if(session()->has('FRONT_USER_LOGIN') == null)

                         <!-- Login section -->
                        <div class="panel panel-default aa-checkout-login">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                Client Login 
                              </a>
                            </h4>
                          </div>
                          <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="panel-body">
                              
                              <a href="" class="aa-browse-btn" data-toggle="modal" data-target="#login-modal">Login</a>
                              
                            </div>
                          </div>
                        </div>
                    
                      @endif

                     

                     
                     
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="checkout-right">
                    <h4>Order Summary</h4>
                    <div class="aa-order-summary-area">
                      <table class="table table-responsive">
                        <thead>
                          <tr>
                            <th>Product</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>

                          @php
                            $totalprice = 0;
                          @endphp

                          @foreach($cart_data as $list)

                          @php
                            $totalprice = $totalprice + ($list->price * $list->qty);
                          @endphp

                          <tr>
                            <td>{{ $list->name }} <strong> x  {{ $list->qty }}</strong>
                             <br/>

                             @if( $list->color != null )
                              Color: {{ $list->color }} 
                              @endif

                              <br/>

                              @if( $list->size != null )
                              Size: {{ $list->size }}
                              @endif

                            </td>
                            <td>RS {{ $list->price * $list->qty }}</td>
                          </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                          <tr class="hide show_coupon_box">
                            <th>Coupon Code <a href="javascript:void(0)" onclick="remove_coupon()" class="remove_coupon text-danger"><small> Remove</small></a></th>
                            <td id="coupon_code_str"></td>
                          </tr>

                          <tr class="hide show_coupon_box">
                            <th>Discount</th>
                            <td id="coupon_code_value"></td>
                          </tr>

                           <tr>
                            <th>Total</th>
                            <td id="total_price">Rs {{ $totalprice }}</td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                    <h4>Payment Method</h4>
                    <div class="aa-payment-method">                    
                      <label for="cashdelivery">
                        <input type="radio" id="cashdelivery" name="payment_type" value="COD"checked > Cash on Delivery 
                      </label>
                      <label for="paypal">
                        <input type="radio" id="paypal" name="payment_type"  value="paypal"> Via Paypal 
                      </label>    
                      <input type="submit" value="Place Order" class="aa-browse-btn" id="btnPlaceOrder">      
                      @csrf      
                      <div id="order_place_msg">  </div>      
                    </div>

                  </div>
                </div>
              </div>
            </form>
           </div>
         </div>
       </div>
     </div>
   </section>
   <!-- / Cart view section -->

{{-- <input type="hidden" id="qty" value="1"/>
<form id="frmAddToCart" >
      
      <input type="hidden" id="size_id" name="size_id" />
      <input type="hidden" id="color_id" name="color_id"/>
      <input type="hidden" id="pqty" name="pqty"/>
      <input type="hidden" id="product_id" name="product_id"/>
      @csrf

</form>
 --}}
@endsection