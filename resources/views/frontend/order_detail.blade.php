@extends('frontend/layout');
@section('page_title','Order Detail Page')
@section('container')


  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <img src="{{asset('front_assets/img/fashion/fashion-header-bg-8.jpg')}}" alt="fashion img">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Order Detail Page</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>                   
          <li class="active">Order Detail</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

 <!-- Cart view section -->
 <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-8">    
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="">
              
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($product_detail as $list)
                      <tr>

                        @if($list->attr_image == '')
                        <td><img src="{{ asset('storage/media/dummy.jpg') }}" class="img-thumbnail order_image" width="80px" height="50px"></td>
                        @else
                        <td><img src="{{ asset('storage/media/'.$list->attr_image) }}" class="img-thumbnail order_image" width="80px" height="50px"></td>
                        @endif

                        <td>{{ $list->name }}</td>
                        <td>{{ $list->size }}</td>
                        <td>{{ $list->color }}</td>
                        <td>{{ $list->qty }}</td>
                        <td>{{ $list->price }}</td>
                        <td>{{ $list->qty * $list->price }}</td>
                        
                        
                        
                      </tr>
                      @endforeach
                    
                    
                      </tbody>
                  </table>
                </div>

             </form>
             <!-- Cart Total view -->
             <div class="cart-view-total">
               <h4>Cart Totals</h4>
               <table class="aa-totals-table">
                 <tbody>
                   
                   <tr>
                     <th>Total</th>
                     <td>{{ $list->total_amount }}</td>
                   </tr>


                   <?php
                
                   if($product_detail[0]->coupon_value > 0)
                   {
                      echo '<tr>
                     <th>Coupon Code</th>
                     <td>'.$product_detail[0]->coupon_code.'</td>
                     </tr>';

                      echo '<tr>
                     <th>Discount</th>
                     <td>'.$product_detail[0]->coupon_value.'</td>
                     </tr>';

                     echo '<tr>
                     <th>New Total</th>
                     <td>'.($product_detail[0]->total_amount - $product_detail[0]->coupon_value).'</td>
                     </tr>';
                   }
                      

                   ?>
                 </tbody>
               </table>
               <a href="#" class="aa-cart-view-btn">Proced to Checkout</a>
             </div>
           </div>
         </div>
       </div>
       <div class="col-md-4">
         <div class="col-md-6 order_detail">
         <h3>Address</h3>
         <ul>
            <li >Address: {{ $product_detail[0]->address }}</li>
            <li>City: {{ $product_detail[0]->city }}</li>
            <li>State: {{ $product_detail[0]->state }}</li>
            <li>Zip: {{ $product_detail[0]->pincode }}</li>
         </ul>
       </div>
         <div class="col-md-6 order_detail">
          <h3>Order Details</h3>
          <ul>
            <li>Order Status: {{ $product_detail[0]->order_status }}</li>
            <li>Payment Type: {{ $product_detail[0]->payment_type }}</li>
            <li>Payment Status: {{ $product_detail[0]->payment_status }}</li>
            <li>Payment Id: {{ $product_detail[0]->payment_id }}</li>
         </ul>
         <h3>Tracking Details</h3>
          <ul>
            <li>{{ $product_detail[0]->track_details }}</li>
            
         </ul>
       </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->

@endsection