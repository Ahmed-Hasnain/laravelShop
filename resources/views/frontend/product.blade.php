@extends('frontend/layout');
@section('page_title',$product[0]->name)
@section('container')

{{-- @php

              echo "<pre>";
               // print_r($result['product_images']);
               print_r($product_attr[0]);
               die();

@endphp --}}

  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <img src="{{asset('storage/media/'.$product[0]->image)}}" alt="fashion img" height="60%" width="100%">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>T-Shirt</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>         
          <li><a href="#">Product</a></li>
          <li class="active">T-shirt</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

  <!-- product category -->
  <section id="aa-product-details">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-product-details-area">
            <div class="aa-product-details-content">
              <div class="row">
                <!-- Modal view slider -->
                <div class="col-md-5 col-sm-5 col-xs-12">                              
                  <div class="aa-product-view-slider">                                
                    <div id="demo-1" class="simpleLens-gallery-container">
                      <div class="simpleLens-container">
                        <div class="simpleLens-big-image-container"><a data-lens-image="{{asset('storage/media/'.$product[0]->image)}}" class="simpleLens-lens-image"><img src="{{asset('storage/media/'.$product[0]->image)}}" class="simpleLens-big-image"></a></div>
                      </div>
                      <div class="simpleLens-thumbnails-container">

                          <a data-big-image="{{asset('storage/media/'.$product[0]->image)}}" data-lens-image="{{asset('storage/media/'.$product[0]->image)}}" class="simpleLens-thumbnail-wrapper" href="#">
                            <img src="{{asset('storage/media/'.$product[0]->image)}}" width="50">
                          </a>         

                          @if(isset($product_images[$product[0]->id][0]))

                            @foreach($product_images[$product[0]->id] as $list)
                                <a data-big-image="{{asset('storage/media/'.$list->images)}}" data-lens-image="{{asset('storage/media/'.$list->images)}}" class="simpleLens-thumbnail-wrapper" href="#">
                            <img src="{{asset('storage/media/'.$list->images)}}" width="50">
                          </a>
                            @endforeach

                          @endif                           
                          
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal view content -->
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <div class="aa-product-view-content">
                    <h3>{{ $product[0]->name }}</h3>
                    <div class="aa-price-block">
                      <span class="aa-product-view-price">Rs {{$product_attr[0]->price }}</span>
                      <p class="aa-product-avilability">Avilability: <span>In stock</span></p>

                      @if( $product[0]->lead_time != "" )
                        <p class="lead-time">{{ $product[0]->lead_time }}</p>
                      @endif


                    </div>
                    <p>{!! $product[0]->short_desc !!}</p>

                    @if($product_attr[0]->size_id > 0)
                    <h4>Size</h4>
                    <div class="aa-prod-view-size">

                      @php
                        $arrSize = [];
                        foreach($product_attr as $size)
                        {
                            $arrSize[] = $size->size;
                        }
                          $arrSize = array_unique($arrSize);
                         // echo "<pre>";
                         // print_r($arrSize);
                         // die();

                      @endphp

                      @foreach($arrSize as $size)
                      @if($size != "")
                      <a href="javascript:void(0)" id="size_{{ $size }}" class="size_link" onclick="showColor('{{ $size }}')">{{ $size }}</a>
                      @endif
                      @endforeach 
                     
                    </div>
                      @endif
                      

                      @if($product_attr[0]->color_id > 0)

                    <h4>Color</h4>
                    <div class="aa-prod-view-size">

                      @foreach($product_attr as $color)
                      @if($color->color != "")
                      <a href="javascript:void(0)"  class="product_color size_{{ $color->size }}" onclick="change_product_color_image('{{asset('storage/media/'.$color->attr_image)}}','{{ $color->color }}')">{{ $color->color }}</a>
                      @endif
                      @endforeach  

                    </div>

                      @endif

                    <div class="aa-prod-quantity">
                      <form action="">
                        <select id="qty" name="qty">
                          @for($i=1;$i<=($product_attr[0]->qty) ;$i++)
                          <option  value="{{ $i }}">{{ $i }}</option>
                          @endfor
                        </select>
                      </form>
                      <p class="aa-prod-category">
                        Category: <a href="#">{{ $product[0]->model }}</a>
                      </p>
                    </div>
                    <div class="aa-prod-view-bottom">
                      <a class="aa-add-to-cart-btn" href="javascript:void(0)" onclick="add_to_cart('{{ $product[0]->id }}','{{ $product_attr[0]->size_id }}','{{ $product_attr[0]->color_id }}')">Add To Cart</a>
                    </div>
                    <div id="add_to_cart_msg">
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="aa-product-details-bottom">
              <ul class="nav nav-tabs" id="myTab2">
                <li><a href="#description" data-toggle="tab">Description</a></li>
                <li><a href="#keywords" data-toggle="tab">Keywords</a></li>
                <li><a href="#technical_specs" data-toggle="tab">Technical Specs</a></li>
                <li><a href="#uses" data-toggle="tab">Uses</a></li>
                <li><a href="#warranty" data-toggle="tab">Warranty</a></li>
                <li><a href="#review" data-toggle="tab">Reviews</a></li>                
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane fade in active" id="description">
                  {!! $product[0]->desc !!}
                </div>
                <div class="tab-pane fade  " id="keywords">
                  {!! $product[0]->keywords !!}
                </div>
                <div class="tab-pane fade " id="technical_specs">
                  {!! $product[0]->technical_specs !!}
                </div>
                <div class="tab-pane fade " id="uses">
                  {!! $product[0]->uses !!}
                </div>
                <div class="tab-pane fade " id="warranty">
                  {!! $product[0]->warranty !!}
                </div>


                {{-- Tab for Product Review --}}
                <div class="tab-pane fade " id="review">
                 <div class="aa-product-review-area">
                   <h4>2 Reviews for T-Shirt</h4> 
                   <ul class="aa-review-nav">

                    @foreach($product_reviews as $review)
                     <li>
                        <div class="media">
                          <div class="media-body">
                            <h4 class="media-heading"><strong>{{ $review->name }}</strong> - <span>{{ getCustomDate($review->added_on) }}</span></h4>
                            <div class="aa-product-rating">
                              <span > {{ $review->rating }} </span>
                            </div>
                            <p>{{ $review->review }}</p>
                          </div>
                        </div>
                      </li>
                      @endforeach
                     
                   </ul>
                   <h4>Add a review</h4>
                   <form id="frmProductReview" class="aa-review-form">
                   <div class="aa-your-rating">
                     <label for="message">Your Rating</label>
                    <select class="form-control" name="rating">
                        <option value="">Select Rating</option>
                        <option value="Best">Best</option>
                        <option value="Better">Better</option>
                        <option value="Good">Good</option>
                        <option value="Satisfactory">Satisfactory</option>
                        <option value="Bad">Bad</option>
                        <option value="Worst">Worst</option>
                    </select>
    
                   </div>
                   <!-- review form -->
                   
                      <div class="form-group">
                        <label for="message">Your Review</label>
                        <textarea class="form-control" rows="3" name="review" required></textarea>
                      </div>

                      <button type="submit" class="btn btn-default aa-review-submit">Submit</button>
                      <input type="hidden" name="product_id" value="{{ $product[0]->id }}">
                      @csrf
                   </form>
                   <div id="product_review_msg" class="text-danger font-weight-bold"></div>
                 </div>
                </div>            
              </div>
            </div>


            <!-- Related product -->
            <div class="aa-product-related-item">
              <h3>Related Products</h3>
              <ul class="aa-product-catg aa-related-item-slider">
                <!-- start single product item -->
                @if(isset($related_products[0]))
                        <!-- start single product item -->
                        @foreach($related_products as $productArr )
                        <li>
                          <figure>
                            <a class="aa-product-img " href="{{ url('product/'.$productArr->slug) }}"><img src="{{asset('storage/media/'.$productArr->image)}} " alt="{{$productArr->name}}"></a>
                            <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <figcaption>
                              <h4 class="aa-product-title"><a href="{{ url('product/'.$productArr->slug) }}">{{$productArr->name}}</a></h4>
                              <span class="aa-product-price">Rs {{ $related_product_attr[$productArr->id][0]->price }}</span><span class="aa-product-price"><del>Rs {{ $related_product_attr[$productArr->id][0]->mrp }}</del></span>
                            </figcaption>
                          </figure>                        
                          <div class="aa-product-hvr-content">
                            {{-- <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a> --}}
                                                  
                          </div>
                          <!-- product badge -->
                          <span class="aa-badge aa-sale" href="#">SALE!</span>
                        </li>
                        @endforeach

                        @else

                        <li>
                            <figure>
                            
                              <h2>Products of this category are out of stock.</h2>

                          </figure>

                        </li>

                        @endif
                 <!-- start single product item -->
                                                                                                 
              </ul>
              <!-- quick view modal -->                  
              {{-- <div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">                      
                    <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <div class="row">
                        <!-- Modal view slider -->
                        <div class="col-md-6 col-sm-6 col-xs-12">                              
                          <div class="aa-product-view-slider">                                
                            <div class="simpleLens-gallery-container" id="demo-1">
                              <div class="simpleLens-container">
                                  <div class="simpleLens-big-image-container">
                                      <a class="simpleLens-lens-image" data-lens-image="{{asset('front_assets/img/view-slider/large/polo-shirt-1.png')}}">
                                          <img src="{{asset('front_assets/img/view-slider/medium/polo-shirt-1.png')}}" class="simpleLens-big-image">
                                      </a>
                                  </div>
                              </div>
                              <div class="simpleLens-thumbnails-container">
                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="{{asset('front_assets/img/view-slider/large/polo-shirt-1.png')}}"
                                     data-big-image="{{asset('front_assets/img/view-slider/medium/polo-shirt-1.png')}}">
                                      <img src="{{asset('front_assets/img/view-slider/thumbnail/polo-shirt-1.png')}}">
                                  </a>                                    
                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="{{asset('front_assets/img/view-slider/large/polo-shirt-3.png')}}"
                                     data-big-image="{{asset('front_assets/img/view-slider/medium/polo-shirt-3.png')}}">
                                      <img src="{{asset('front_assets/img/view-slider/thumbnail/polo-shirt-3.png')}}">
                                  </a>

                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="{{asset('front_assets/img/view-slider/large/polo-shirt-4.png')}}"
                                     data-big-image="{{asset('front_assets/img/view-slider/medium/polo-shirt-4.png')}}">
                                      <img src="{{asset('front_assets/img/view-slider/thumbnail/polo-shirt-4.png')}}">
                                  </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Modal view content -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="aa-product-view-content">
                            <h3>T-Shirt</h3>
                            <div class="aa-price-block">
                              <span class="aa-product-view-price">$34.99</span>
                              <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis animi, veritatis quae repudiandae quod nulla porro quidem, itaque quis quaerat!</p>
                            <h4>Size</h4>
                            <div class="aa-prod-view-size">
                              <a href="#">S</a>
                              <a href="#">M</a>
                              <a href="#">L</a>
                              <a href="#">XL</a>
                            </div>
                            <div class="aa-prod-quantity">
                              <form action="">
                                <select name="" id="">
                                  <option value="0" selected="1">1</option>
                                  <option value="1">2</option>
                                  <option value="2">3</option>
                                  <option value="3">4</option>
                                  <option value="4">5</option>
                                  <option value="5">6</option>
                                </select>
                              </form>
                              <p class="aa-prod-category">
                                Category: <a href="#">Polo T-Shirt</a>
                              </p>
                            </div>
                            <div class="aa-prod-view-bottom">
                              <a href="#" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <a href="#" class="aa-add-to-cart-btn">View Details</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>                        
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div> --}}
              <!-- / quick view modal -->   
            </div>  
          </div>
        </div>
      </div>
    </div>
  </section> 

  <form id="frmAddToCart" >
      
      <input type="hidden" id="size_id" name="size_id" />
      <input type="hidden" id="color_id" name="color_id"/>
      <input type="hidden" id="pqty" name="pqty"/>
      <input type="hidden" id="product_id" name="product_id"/>
      @csrf

  </form>


  <!-- / product category -->


@endsection