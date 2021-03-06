@extends('frontend/layout');
@section('page_title','Category')
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
        <h2>Fashion</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>         
          <li class="active">Women</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

  <!-- product category -->
  <section id="aa-product-category">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
          <div class="aa-product-catg-content">
            <div class="aa-product-catg-head">
              <div class="aa-product-catg-head-left">
                <form action="" class="aa-sort-form">
                  <label for="">Sort by</label>
                  <select name="" onchange="sort_by()" id="sort_by_value">
                    <option value="" selected="Default">Default</option>
                    <option value="name">Name</option>
                    <option value="price_desc">Price-Decending</option>
                    <option value="price_asc">Price-Ascending</option>
                    <option value="date">Date</option>
                  </select>
                </form>
                {{ $sort_text }}
                <form action="" class="aa-show-form">
                  <label for="">Show</label>
                  <select name="">
                    <option value="1" selected="12">12</option>
                    <option value="2">24</option>
                    <option value="3">36</option>
                  </select>
                </form>
              </div>
              <div class="aa-product-catg-head-right">
                <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
              </div>
            </div>
            <div class="aa-product-catg-body">
              <ul class="aa-product-catg">
                <!-- start single product item -->
                @if(isset($product[0]))
                        <!-- start single product item -->
                        @foreach($product as $productArr )
                        <li>
                          <figure>
                            <a class="aa-product-img " href="{{ url('product/'.$productArr->slug) }}"><img src="{{asset('storage/media/'.$productArr->image)}} " alt="{{$productArr->name}}"></a>
                            <a class="aa-add-card-btn"href="#" onclick="home_add_to_cart('{{ $productArr->id }}','{{ $product_attr[$productArr->id][0]->size }}','{{ $product_attr[$productArr->id][0]->color }}')" ><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <figcaption>
                              <h4 class="aa-product-title"><a href="{{ url('product/'.$productArr->slug) }}">{{$productArr->name}}</a></h4>
                              <span class="aa-product-price">Rs {{ $product_attr[$productArr->id][0]->price }}</span><span class="aa-product-price"><del>Rs {{ $product_attr[$productArr->id][0]->mrp }}</del></span>
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
                                          
              </ul>
               
            </div>

            <div class="aa-product-catg-pagination">
              <nav>
                <ul class="pagination">
                  <li>
                    <a href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  <li><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li><a href="#">5</a></li>
                  <li>
                    <a href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
          <aside class="aa-sidebar">
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Category</h3>
              <ul class="aa-catg-nav">
                @foreach($sidebar_categories as $list)

                  
                  <li>
                    @if($slug == $list->category_slug)
                    <a href="{{ url('category/'.$list->category_slug) }}" class="sidebar_cat">{{ $list->category_name }}</a>
                  @else
                    <a href="{{ url('category/'.$list->category_slug) }}">{{ $list->category_name }}</a>
                    @endif
                  </li>
                  
                @endforeach 
              </ul>
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Tags</h3>
              <div class="tag-cloud">
                @foreach($sidebar_categories as $list)
                 @if($slug == $list->category_slug)
                  <a href="{{ url('category/'.$list->category_slug) }}" class="sidebar_cat">{{ $list->category_name }}</a>
                  @else
                  <a href="{{ url('category/'.$list->category_slug) }}">{{ $list->category_name }}</a>
                  @endif
                @endforeach 
              </div>
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Shop By Price</h3>              
              <!-- price range -->
              <div class="aa-sidebar-price-range">
               <form action="">
                  <div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                  </div>
                  <span id="skip-value-lower" class="example-val">30.00</span>
                 <span id="skip-value-upper" class="example-val">100.00</span>
                 <button class="aa-filter-btn" type="button" onclick="sort_price_filter()">Filter</button>
               </form>
              </div>              

            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Shop By Color</h3>
              <div class="aa-color-tag">
                @foreach($colors as $color)

                @if(in_array($color->id, $colorFilterArr))
                  <a class="active_color aa-color-{{strtolower($color->color)}}" href="javascript:void(0)" onclick="color_filter('{{ $color->id }}','1')"></a>

                @else
                  <a class="aa-color-{{strtolower($color->color)}}" href="javascript:void(0)" onclick="color_filter('{{ $color->id }}','0')"></a>

                @endif

                @endforeach
                
              </div>                            
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Recently Views</h3>
              <div class="aa-recently-views">
                <ul>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="{{asset('front_assets/img/woman-small-2.jpg')}}"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>                                    
                </ul>
              </div>                            
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Top Rated Products</h3>
              <div class="aa-recently-views">
                <ul>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="{{asset('front_assets/img/woman-small-2.jpg')}}"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>                                      
                </ul>
              </div>                            
            </div>
          </aside>
        </div>
       
      </div>
    </div>
  </section>
  <!-- / product category -->

<input type="hidden" id="qty" value="1"/>
<form id="frmAddToCart" >
      
      <input type="hidden" id="size_id" name="size_id" />
      <input type="hidden" id="color_id" name="color_id"/>
      <input type="hidden" id="pqty" name="pqty"/>
      <input type="hidden" id="product_id" name="product_id"/>
      @csrf

</form>

<form id="categoryFilter" >
      
       <input type="hidden" id="sort" name="sort" value="{{ $sort }}" />
      <input type="hidden" id="filter_price_start" name="filter_price_start" value="{{ $filter_price_start }}" />
      <input type="hidden" id="filter_price_end" name="filter_price_end" value="{{ $filter_price_end }}"/>
      <input type="hidden" id="color-filter" name="color-filter" value="{{ $color_filter }}" />
      

  </form>


  <!-- / product category -->


@endsection