@extends('frontend/layout');
@section('page_title','Order Page')
@section('container')


  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <img src="{{asset('front_assets/img/fashion/fashion-header-bg-8.jpg')}}" alt="fashion img">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Order Page</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>                   
          <li class="active">Order</li>
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
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="">
              
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Order Id</th>
                        <th>Order Status</th>
                        <th>Payment Status</th>
                        <th>Payment Type</th>
                        <th>Total Amount</th>
                        <th>Payment Id</th>
                        <th>Placed At</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($order as $list)
                      <tr>
                        <td><a href="{{ url('/order_detail') }}/{{ $list->id }}">{{ $list->id }}</a></td>
                        <td>{{ $list->order_status }}</td>
                        <td>{{ $list->payment_status }}</td>
                        <td>{{ $list->payment_type }}</td>
                        <td>{{ $list->total_amount }}</td>
                        <td>{{ $list->payment_id }}</td>
                        <td>{{ $list->added_on }}</td>
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
                     <th>Subtotal</th>
                     <td>$450</td>
                   </tr>
                   <tr>
                     <th>Total</th>
                     <td>$450</td>
                   </tr>
                 </tbody>
               </table>
               <a href="#" class="aa-cart-view-btn">Proced to Checkout</a>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->

@endsection