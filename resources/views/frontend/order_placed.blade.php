@extends('frontend/layout');
@section('page_title','Thank You')
@section('container')


  <!-- product category -->
  <section id="aa-product-category">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-8 ">
          <div class="aa-product-catg-content">
            
            <h2>Thank you for placing the order. You will be notified shortly via E-mail. </h2> 
            <h3>Order Id :{{ session()->get('ORDER_ID') }} </h3>
            

          </div>
        </div>
        
       
      </div>
    </div>
  </section>
  <!-- / product category -->




@endsection