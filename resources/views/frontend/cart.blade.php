@extends('frontend/layout');
@section('page_title','Cart Page')
@section('container')


  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <img src="{{asset('front_assets/img/fashion/fashion-header-bg-8.jpg')}}" alt="fashion img">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Cart Page</h2>
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
 <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="">
              @if(isset($list[0]))
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th></th>
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($list as $cart_data)
                      <tr id="cart_box_{{$cart_data->attr_id}}">
                        <td><a class="remove" href="javascript:void(0)" onclick="deleteCartProduct('{{$cart_data->pid}}','{{$cart_data->color}}','{{$cart_data->size}}','{{$cart_data->attr_id}}')"><fa class="fa fa-close"></fa></a></td>
                        <td><a href="{{ url('product/'.$cart_data->slug) }}"><img src="{{asset('storage/media/'.$cart_data->image)}}" alt="img"></a></td>
                        <td><a class="aa-cart-title" href="{{ url('product/'.$cart_data->slug) }}">{{ $cart_data->name }}</a>
                          @if($cart_data->size != '')
                          <br>SIZE: {{ $cart_data->size }}
                          @endif

                          @if($cart_data->color != '')
                          <br>COLOR: {{ $cart_data->color }}
                          @endif
                        </td>
                        <td>Rs {{ $cart_data->price }}</td>
                        <td><input class="aa-cart-quantity" type="number" value="{{$cart_data->qty }}" id="qty-{{$cart_data->attr_id}}" onchange="updateQty('{{$cart_data->pid}}','{{$cart_data->color}}','{{$cart_data->size}}','{{$cart_data->attr_id}}','{{$cart_data->price}}')"></td>
                        <td id="total_price_{{$cart_data->attr_id}}">Rs{{ ($cart_data->qty)*($cart_data->price) }}</td>
                      </tr>
                    @endforeach
                    <tr>
                      <td colspan="6" class="aa-cart-view-bottom">
                        {{-- <input type="button" value="Checkout" class="aa-cart-view-btn"> --}}
                        <a class="aa-cart-view-btn" href="{{ url('/checkout') }}">Checkout</a>
                      </td>
                    </tr>
                    
                      </tbody>
                  </table>
                </div>

                @else

                  <h3>Cart Is Empty</h3>

                @endif



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

<input type="hidden" id="qty" value="1"/>
<form id="frmAddToCart" >
      
      <input type="hidden" id="size_id" name="size_id" />
      <input type="hidden" id="color_id" name="color_id"/>
      <input type="hidden" id="pqty" name="pqty"/>
      <input type="hidden" id="product_id" name="product_id"/>
      @csrf

</form>

@endsection