@php
  
  use Illuminate\Support\Facades\DB;

  $result = DB::table('categories')
            ->where(['status'=>1])
            ->where(['parent_category_id'=>0])
            ->get();

  $result_new = DB::table('categories')
            ->where(['status'=>1])
            ->get();

  // dd($result_new);


@endphp



  <!-- menu -->
  <section id="menu">
    <div class="container">
      <div class="menu-area">
        <!-- Navbar -->
        <div class="navbar navbar-default" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>          
          </div>
          <div class="navbar-collapse collapse">
            <!-- Left nav -->
            <ul class="nav navbar-nav">

              <li class="text-uppercase"><a href="Home.html">Home</a></li>
              @foreach($result as $cat_data )

                 <li class="text-uppercase"><a href="{{ url('category/'.$cat_data->category_slug) }}">{{ $cat_data->category_name }}</a>

                   
                    <ul class="dropdown-menu">

                      @foreach($result_new as $cat_child_data )

                        @if($cat_data->id == $cat_child_data->parent_category_id)

                        <li class="text-uppercase"><a href="{{ url('category/'.$cat_child_data->category_slug) }}">{{ $cat_child_data->category_name }}</a></li>

                        @endif

                      @endforeach 

                    </ul>

                 </li>

              @endforeach
              <li class="text-uppercase"><a href="contact.html">Contact</a></li>



             {{--  <li><a href="#">Men <span class="caret"></span></a>
                <ul class="dropdown-menu">                
                  <li><a href="#">Casual</a></li>
                  <li><a href="#">Sports</a></li>
                  <li><a href="#">Formal</a></li>
                  <li><a href="#">Standard</a></li>                                                
                  <li><a href="#">T-Shirts</a></li>
                  <li><a href="#">Shirts</a></li>
                  <li><a href="#">Jeans</a></li>
                  <li><a href="#">Trousers</a></li>
                  <li><a href="#">And more.. <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">Sleep Wear</a></li>
                      <li><a href="#">Sandals</a></li>
                      <li><a href="#">Loafers</a></li>                                      
                    </ul>
                  </li>
                </ul>
              </li>
              <li><a href="contact.html">Contact</a></li> --}}
              
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>       
    </div>
  </section>
  <!-- / menu -->

