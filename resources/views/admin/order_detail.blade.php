@extends('admin/layout')
@section('page_title','Order Detail')
@section('tax_selected','active')
@section('container')

	<h2 class="ml-3">Order Id - {{ $product_detail[0]->id }}</h2>

       <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3">
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

    <div class="col-md-12 bg-white p-3 order_operation mb-5" >
        <h3>Update Order Status</h3>
        <br>
        <select class="form-control" id="order_status" onchange="update_order_status('{{ $product_detail[0]->id }}')">

             @foreach($order_status as $list1)

                @if($product_detail[0]->order_status == $list1->order_status)
                    <option value="{{ $list1->id }}" selected>{{ $list1->order_status }}</option>
                @else
                    <option value="{{ $list1->id }}">{{ $list1->order_status }}</option>
                @endif
                
             @endforeach
        </select>
        <br>
         <h3>Update Payment Status</h3>
        <br>
        <select class="form-control" id="payment_status" onchange="update_payment_status('{{ $product_detail[0]->id }}')">

             @foreach($payment_status as $list1)

                @if($product_detail[0]->payment_status == $list1)
                    <option value="{{ $list1 }}" selected>{{ $list1 }}</option>
                @else
                    <option value="{{ $list1 }}">{{ $list1 }}</option>
                @endif
                
             @endforeach
        </select>
        <br>
        <h3>Track Details</h3>
        <br>
        <form method="post" > 
            <textarea name="track_detail" class="form-control" required>
                {{ $product_detail[0]->track_details }}
            </textarea>
            <input type="submit" name="submit" class="form-control p-2 mt-2">
            @csrf
        </form>
        
    </div>
    
        <div class="col-md-4 bg-white p-3">
            <div class="cart-view-total ">
               <h4>Cart Totals</h4>
               <table class="aa-totals-table">
                 <tbody>
                   
                   <tr>
                     <th>Total: </th>
                     <td> Rs {{ $list->total_amount }}</td>
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
              {{--  <a href="#" class="aa-cart-view-btn">Proced to Checkout</a> --}}
             </div>
        </div>

        <div class="col-md-4 bg-white p-3">
            <h3>Address</h3>
         <ul>
            <li >Address: {{ $product_detail[0]->address }}</li>
            <li>City: {{ $product_detail[0]->city }}</li>
            <li>State: {{ $product_detail[0]->state }}</li>
            <li>Zip: {{ $product_detail[0]->pincode }}</li>
         </ul>
        </div>

        <div class="col-md-4 bg-white p-3">
            <h3>Order Detail</h3>
          <ul>
            <li>Order Status: {{ $product_detail[0]->order_status }}</li>
            <li>Payment Type: {{ $product_detail[0]->payment_type }}</li>
            <li>Payment Status: {{ $product_detail[0]->payment_status }}</li>
            <li>Payment Id: {{ $product_detail[0]->payment_id }}</li>
         </ul>
        </div>
    

    



@endsection