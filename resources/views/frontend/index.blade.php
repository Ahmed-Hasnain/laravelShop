@extends('frontend/layout');
@section('page_title','Home Page')
@section('container')

  <!-- Start slider -->
  <section id="aa-slider">
    <div class="aa-slider-area">
      <div id="sequence" class="seq">
        <div class="seq-screen">
          <ul class="seq-canvas">

            <!-- single slide item -->
            @foreach($home_banners as $banner_data )
            <li>
              <div class="seq-model">
                <img data-seq src="{{asset('storage/media/'.$banner_data->image)}}" alt="{{ $banner_data->heading }}" />
              </div>
              <div class="seq-title">
               <span data-seq>{{ $banner_data->text_1 }}</span>                
                <h2 data-seq>{{ $banner_data->heading }}</h2>                
                <p data-seq>{{ $banner_data->text_2 }}</p>
                <a data-seq href="{{ $banner_data->btn_link }}" class="aa-shop-now-btn aa-secondary-btn">{{ $banner_data->btn_txt }}</a>
              </div>
            </li>
            @endforeach
            <!-- single slide item -->
                           
          </ul>
        </div>
        <!-- slider navigation btn -->
        <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
          <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
          <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
        </fieldset>
      </div>
    </div>
  </section>
  <!-- / slider -->

  
  <!-- Start Promo section -->
  <section id="aa-promo">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-promo-area">
            <div class="row">
              <div class="col-md-12 no-padding">
                <div class="aa-promo-right">

                  @foreach($home_categories as $cat_data )

                  <div class="aa-single-promo-right p-2">
                    <div class="aa-promo-banner">                      
                      <img src="{{asset('storage/media/'.$cat_data->category_image)}}" alt="img">                      
                      <div class="aa-prom-content">
                        <span>Exclusive Item</span>
                        <h4><a href="{{ url('category/'.$cat_data->category_slug) }}">{{ $cat_data->category_name }}</a></h4>                        
                      </div>
                    </div>
                  </div>

                  @endforeach

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Promo section -->


  <!-- Products section -->
  <section id="aa-product">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-product-area">
              <div class="aa-product-inner">
                <!-- start prduct navigation -->
                 <ul class="nav nav-tabs aa-products-tab">

                  @foreach($home_categories as $cat_data )
                    <li class=""><a href="#cat{{ $cat_data->id }}" data-toggle="tab">{{ $cat_data->category_name }}</a></li>
                  @endforeach

                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">

                    @php
                      $loop_count=1;
                    @endphp

                    @foreach($home_categories as $cat_data )

                      @php
                        $cat_class="";
                        if ($loop_count == 1) {
                          $cat_class="in active";
                          $loop_count++;
                        }
                      @endphp

                    <!-- Start men product category -->
                    <div class="tab-pane fade {{ $cat_class }}" id="cat{{ $cat_data->id }}">
                      <ul class="aa-product-catg">

                        @if(isset($home_categories_product[$cat_data->id][0]))
                        <!-- start single product item -->
                        @foreach($home_categories_product[$cat_data->id] as $productArr )
                        <li>
                          <figure>
                            <a class="aa-product-img " href="{{ url('product/'.$productArr->slug) }}"><img src="{{asset('storage/media/'.$productArr->image)}} " alt="{{$productArr->name}}"></a>
                            <a class="aa-add-card-btn"href="javascript:void(0)" onclick="home_add_to_cart('{{ $productArr->id }}','{{ $home_product_attr[$productArr->id][0]->size }}','{{ $home_product_attr[$productArr->id][0]->color }}')" ><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <figcaption>
                              <h4 class="aa-product-title"><a href="{{ url('product/'.$productArr->slug) }}">{{$productArr->name}}</a></h4>
                              <span class="aa-product-price">Rs {{ $home_product_attr[$productArr->id][0]->price }}</span><span class="aa-product-price"><del>Rs {{ $home_product_attr[$productArr->id][0]->mrp }}</del></span>
                            </figcaption>
                          </figure>                        
                          <div class="aa-product-hvr-content">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                                  
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
                      
                    </div>
                    <!-- / men product category -->
                    @endforeach



                  </div>  



              </div>
            </div>
          </div>

        </div>
        {{--   <a class="aa-browse-btn text-center" href="{{ url('product/'.$productArr->slug) }}">Browse all Product <span class="fa fa-long-arrow-right"></span></a> --}}
      </div>
    </div>
  </section>
  <!-- / Products section -->


  <!-- banner section -->
  <section id="aa-banner">
    <div class="container">
      <div class="row">
        <div class="col-md-12">        
          <div class="row">
            <div class="aa-banner-area">
            <a href="#"><img src="{{asset('front_assets/img/fashion-banner.jpg')}}" alt="fashion banner img"></a>
          </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- popular section -->
  <section id="aa-popular-category">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-popular-category-area">
              <!-- start prduct navigation -->
             <ul class="nav nav-tabs aa-products-tab">
                <li class="active"><a href="#promo" data-toggle="tab">Promo</a></li>
                <li><a href="#featured" data-toggle="tab">Featured</a></li>
                <li><a href="#discounted" data-toggle="tab">Discounted</a></li>                    
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
                <!-- Start men Promo category -->
                <div class="tab-pane fade in active" id="promo">
                  <ul class="aa-product-catg aa-popular-slider">
                    <!-- start single product item -->
                      @if(isset($home_promo_product[$cat_data->id][0]))
                        <!-- start single product item -->
                        @foreach($home_promo_product[$cat_data->id] as $productArr )
                        <li>
                          <figure>
                            <a class="aa-product-img " href="{{ url('product/'.$productArr->slug) }}"><img src="{{asset('storage/media/'.$productArr->image)}} " alt="{{$productArr->name}}"></a>
                            <a class="aa-add-card-btn"href="#" onclick="home_add_to_cart('{{ $productArr->id }}','{{ $home_promo_product_attr[$productArr->id][0]->size }}','{{ $home_promo_product_attr[$productArr->id][0]->color }}')" ><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <figcaption>
                              <h4 class="aa-product-title"><a href="{{ url('product/'.$productArr->slug) }}">{{$productArr->name}}</a></h4>
                              <span class="aa-product-price">Rs {{ $home_promo_product_attr[$productArr->id][0]->price }}</span><span class="aa-product-price"><del>Rs {{ $home_promo_product_attr[$productArr->id][0]->mrp }}</del></span>
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
                 {{--  <a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a> --}}
                </div>
                <!-- / popular product category -->
                  
                <!-- start featured product category -->
                <div class="tab-pane fade" id="featured">
                 <ul class="aa-product-catg aa-featured-slider">
                    <!-- start single product item -->
                    
                        @if(isset($home_featured_product[$cat_data->id][0]))
                        <!-- start single product item -->
                        @foreach($home_featured_product[$cat_data->id] as $productArr )
                        <li>
                          <figure>
                            <a class="aa-product-img " href="{{ url('product/'.$productArr->slug) }}"><img src="{{asset('storage/media/'.$productArr->image)}} " alt="{{$productArr->name}}"></a>
                            <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <figcaption>
                              <h4 class="aa-product-title"><a href="{{ url('product/'.$productArr->slug) }}">{{$productArr->name}}</a></h4>
                              <span class="aa-product-price">Rs {{ $home_featured_product_attr[$productArr->id][0]->price }}</span><span class="aa-product-price"><del>Rs {{ $home_featured_product_attr[$productArr->id][0]->mrp }}</del></span>
                            </figcaption>
                          </figure>                        
                          <div class="aa-product-hvr-content">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                                  
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
                  {{-- <a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a> --}}
                </div>
                <!-- / featured product category -->

                <!-- start Discounted product category -->
                <div class="tab-pane fade" id="discounted">
                  <ul class="aa-product-catg aa-latest-slider">
                    <!-- start single product item -->
                      @if(isset($home_discounted_product[$cat_data->id][0]))
                        <!-- start single product item -->
                        @foreach($home_discounted_product[$cat_data->id] as $productArr )
                        <li>
                          <figure>
                            <a class="aa-product-img " href="{{ url('product/'.$productArr->slug) }}"><img src="{{asset('storage/media/'.$productArr->image)}} " alt="{{$productArr->name}}"></a>
                            <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <figcaption>
                              <h4 class="aa-product-title"><a href="{{ url('product/'.$productArr->slug) }}">{{$productArr->name}}</a></h4>
                              <span class="aa-product-price">Rs {{ $home_discounted_product_attr[$productArr->id][0]->price }}</span><span class="aa-product-price"><del>Rs {{ $home_discounted_product_attr[$productArr->id][0]->mrp }}</del></span>
                            </figcaption>
                          </figure>                        
                          <div class="aa-product-hvr-content">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                                                  
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
                   <a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a>
                </div>
                <!-- / latest product category -->              
              </div>
            </div>
          </div> 
        </div>
      </div>
    </div>
  </section>
  <!-- / popular section -->


  <!-- Support section -->
  <section id="aa-support">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-support-area">
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-truck"></span>
                <h4>FREE SHIPPING</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-clock-o"></span>
                <h4>30 DAYS MONEY BACK</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-phone"></span>
                <h4>SUPPORT 24/7</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Support section -->


  <!-- Testimonial -->
  {{-- <section id="aa-testimonial">  
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-testimonial-area">
            <ul class="aa-testimonial-slider">
              <!-- single slide -->
              <li>
                <div class="aa-testimonial-single">
                <img class="aa-testimonial-img" src="{{asset('front_assets/img/testimonial-img-2.jpg')}}" alt="testimonial img">
                  <span class="fa fa-quote-left aa-testimonial-quote"></span>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui!consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui.</p>
                  <div class="aa-testimonial-info">
                    <p>Allison</p>
                    <span>Designer</span>
                    <a href="#">Dribble.com</a>
                  </div>
                </div>
              </li>
              <!-- single slide -->
              <li>
                <div class="aa-testimonial-single">
                <img class="aa-testimonial-img" src="{{asset('front_assets/img/testimonial-img-1.jpg')}}" alt="testimonial img">
                  <span class="fa fa-quote-left aa-testimonial-quote"></span>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui!consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui.</p>
                  <div class="aa-testimonial-info">
                    <p>KEVIN MEYER</p>
                    <span>CEO</span>
                    <a href="#">Alphabet</a>
                  </div>
                </div>
              </li>
               <!-- single slide -->
              <li>
                <div class="aa-testimonial-single">
                <img class="aa-testimonial-img" src="{{asset('front_assets/img/testimonial-img-3.jpg')}}" alt="testimonial img">
                  <span class="fa fa-quote-left aa-testimonial-quote"></span>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui!consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui.</p>
                  <div class="aa-testimonial-info">
                    <p>Luner</p>
                    <span>COO</span>
                    <a href="#">Kinatic Solution</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section> --}}
  <!-- / Testimonial -->


  <!-- Latest Blog -->
{{--   <section id="aa-latest-blog">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-latest-blog-area">
            <h2>LATEST BLOG</h2>
            <div class="row">
              <!-- single latest blog -->
              <div class="col-md-4 col-sm-4">
                <div class="aa-latest-blog-single">
                  <figure class="aa-blog-img">                    
                    <a href="#"><img src="{{asset('front_assets/img/promo-banner-1.jpg')}}" alt="img"></a>  
                      <figcaption class="aa-blog-img-caption">
                      <span href="#"><i class="fa fa-eye"></i>5K</span>
                      <a href="#"><i class="fa fa-thumbs-o-up"></i>426</a>
                      <a href="#"><i class="fa fa-comment-o"></i>20</a>
                      <span href="#"><i class="fa fa-clock-o"></i>June 26, 2016</span>
                    </figcaption>                          
                  </figure>
                  <div class="aa-blog-info">
                    <h3 class="aa-blog-title"><a href="#">Lorem ipsum dolor sit amet</a></h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, ad? Autem quos natus nisi aperiam, beatae, fugiat odit vel impedit dicta enim repellendus animi. Expedita quas reprehenderit incidunt, voluptates corporis.</p> 
                    <a href="#" class="aa-read-mor-btn">Read more <span class="fa fa-long-arrow-right"></span></a>
                  </div>
                </div>
              </div>
              <!-- single latest blog -->
              <div class="col-md-4 col-sm-4">
                <div class="aa-latest-blog-single">
                  <figure class="aa-blog-img">                    
                    <a href="#"><img src="{{asset('front_assets/img/promo-banner-3.jpg')}}" alt="img"></a>  
                      <figcaption class="aa-blog-img-caption">
                      <span href="#"><i class="fa fa-eye"></i>5K</span>
                      <a href="#"><i class="fa fa-thumbs-o-up"></i>426</a>
                      <a href="#"><i class="fa fa-comment-o"></i>20</a>
                      <span href="#"><i class="fa fa-clock-o"></i>June 26, 2016</span>
                    </figcaption>                          
                  </figure>
                  <div class="aa-blog-info">
                    <h3 class="aa-blog-title"><a href="#">Lorem ipsum dolor sit amet</a></h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, ad? Autem quos natus nisi aperiam, beatae, fugiat odit vel impedit dicta enim repellendus animi. Expedita quas reprehenderit incidunt, voluptates corporis.</p> 
                     <a href="#" class="aa-read-mor-btn">Read more <span class="fa fa-long-arrow-right"></span></a>         
                  </div>
                </div>
              </div>
              <!-- single latest blog -->
              <div class="col-md-4 col-sm-4">
                <div class="aa-latest-blog-single">
                  <figure class="aa-blog-img">                    
                    <a href="#"><img src="{{asset('front_assets/img/promo-banner-1.jpg')}}" alt="img"></a>  
                      <figcaption class="aa-blog-img-caption">
                      <span href="#"><i class="fa fa-eye"></i>5K</span>
                      <a href="#"><i class="fa fa-thumbs-o-up"></i>426</a>
                      <a href="#"><i class="fa fa-comment-o"></i>20</a>
                      <span href="#"><i class="fa fa-clock-o"></i>June 26, 2016</span>
                    </figcaption>                          
                  </figure>
                  <div class="aa-blog-info">
                    <h3 class="aa-blog-title"><a href="#">Lorem ipsum dolor sit amet</a></h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, ad? Autem quos natus nisi aperiam, beatae, fugiat odit vel impedit dicta enim repellendus animi. Expedita quas reprehenderit incidunt, voluptates corporis.</p> 
                    <a href="#" class="aa-read-mor-btn">Read more <span class="fa fa-long-arrow-right"></span></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>    
      </div>
    </div>
  </section> --}}
  <!-- / Latest Blog -->


  <!-- Client Brand -->
  <section id="aa-client-brand">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-client-brand-area">
            <ul class="aa-client-brand-slider">

               @foreach($home_brands as $brand_data )

              <li><a href="#"><img src="{{asset('storage/media/'.$brand_data->image)}}" alt="{{$brand_data->brand}}"></a></li>

              @endforeach
              
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Client Brand -->

  <input type="hidden" id="qty" value="1"/>
<form id="frmAddToCart" >
      
      <input type="hidden" id="size_id" name="size_id" />
      <input type="hidden" id="color_id" name="color_id"/>
      <input type="hidden" id="pqty" name="pqty"/>
      <input type="hidden" id="product_id" name="product_id"/>
      @csrf

  </form>

@endsection