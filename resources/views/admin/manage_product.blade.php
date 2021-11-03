@extends('admin/layout')
@section('page_title','Manage product')
@section('product_selected','active')
@section('container')

@if( $id>0 )
    {{ $image_required = "" }}
@else
    {{ $image_required = "required" }}
@endif

    <h2 class="ml-3">Manage product</h2>

    <div class="col-md-12 mt-4">

        @if(session('sku_error'))
            <div class="alert alert-danger">
                {{ session('sku_error') }}  
            </div>
        @endif

        @error('attr_image.*')
            <div class="alert alert-danger">
                {{ $message }}  
            </div>
        @enderror
        
        <a href="{{ url('admin/product/') }}">
            <button type="button" class="btn btn-danger btn-lg btn-block mb-4">
                Back To product 
            </button>
        </a>
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                            
                                <div class="card">
                                    <div class="card-header">Add product</div>
                                    <div class="card-body">
                                        {{-- <div class="card-title">
                                            <h3 class="text-center title-2">Pay Invoice</h3>
                                        </div>
                                        <hr> --}}
                                        <form action="{{ route('product.manage_product_process') }}" method="post" enctype="multipart/form-data">
                                            @csrf


                                            <div class="form-group">
                                                <label for="product" class="control-label mb-1">Name</label>
                                                <input id="name" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $name }}" >
                                            </div>
                                            
                                                
                                            @error('name')
                                                <div class="alert alert-info">
                                                 {{ $message }}
                                                 </div>
                                            @enderror
                                                 
                                            
                                            <div class="form-group">
                                                <label for="code" class="control-label mb-1">Slug</label>
                                                <input id="slug" name="slug" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $slug }}" >
                                            </div>


                                             @error('slug')
                                                <div class="alert alert-info">
                                                 {{ $message }}
                                                 </div>
                                              @enderror


                                              <div class="form-group">
                                                <label for="value" class="control-label mb-1">Image</label>
                                                <input id="image" name="image" type="file" class="form-control" aria-required="false" aria-invalid="false" value="{{ $image }}" {{ $image_required }}>
                                            </div>

                                             @error('image')
                                                <div class="alert alert-info">
                                                 {{ $message }}
                                                 </div>
                                              @enderror

                                              
                                                        <div class="form-group text-center">

                            @if($image == '' )
                            <img src="{{ asset('storage/media/dummy.jpg') }}" class="img-thumbnail " width="50%" height="150px">
                            @else
                            <img src="{{ asset('storage/media/'.$image) }}" class="img-thumbnail " width="50%" height="150px">
                            @endif
                                                    </div>  

                                                 

                                            <div class="form-group">
                                                <label for="category" class="control-label mb-1">Category</label>
                                                
                                                <select id="category" name="category_id" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                        <option value="">Select category</option>
                                                    @foreach($category as $list)
                                                        @if($category_id == $list->id)
                                                        <option selected value="{{ $list->id }}">
                                                            @else
                                                            <option value="{{ $list->id }}">
                                                        @endif
                                                            {{ $list->category_name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>


                                            <div class="form-group">
                                                <label for="brand" class="control-label mb-1">Brand</label>
                                                
                                                <select id="brand" name="brand_id" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                        <option value="">Select Brand</option>
                                                    @foreach($brand as $list)
                                                        @if($brand_id == $list->id)
                                                        <option selected value="{{ $list->id }}">
                                                            @else
                                                            <option value="{{ $list->id }}">
                                                        @endif
                                                            {{ $list->brand }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>

                                            {{-- <div class="form-group">
                                                <label for="brand" class="control-label mb-1">Brand</label>
                                                <input id="brand" name="brand_id" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $brand_id }}" >
                                            </div> --}}

                                            <div class="form-group">
                                                <label for="model" class="control-label mb-1">Model</label>
                                                <input id="model" name="model" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $model }}" >
                                            </div>

                                             <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="code" class="control-label mb-1">Lead Time</label>
                                                         <input id="lead_time" name="lead_time" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $lead_time }}" >
                                                     </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="tax_id" class="control-label mb-1">Tax</label>
                                                         <select id="tax_id" name="tax_id" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                        <option value="">Select Tax</option>
                                                    @foreach($tax as $list)
                                                        @if($tax_id == $list->id)
                                                        <option selected value="{{ $list->id }}">
                                                            @else
                                                            <option value="{{ $list->id }}">
                                                        @endif
                                                            {{ $list->tax_desc }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                     </div>
                                                </div>
                                              {{--   <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="tax_type" class="control-label mb-1">Tax Type</label>
                                                         <input id="tax_type" name="tax_type" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $tax_type }}" >
                                                     </div>
                                                </div> --}}
                                            </div>

                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="is_promo" class="control-label mb-1">Is Promo</label>
                                                        <select id="is_promo" name="is_promo" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                            @if($is_promo == 1)
                                                            <option value="1" selected>Yes</option>
                                                            <option value="0">No</option>
                                                            @else
                                                            <option value="1" >Yes</option>
                                                            <option value="0" selected>No</option>
                                                            @endif
                                                        </select>
                                                     </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="is_featured" class="control-label mb-1">Is Featured</label>
                                                        <select id="is_featured" name="is_featured" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                            @if($is_featured == 1)
                                                            <option value="1" selected>Yes</option>
                                                            <option value="0">No</option>
                                                            @else
                                                            <option value="1" >Yes</option>
                                                            <option value="0" selected>No</option>
                                                            @endif
                                                        </select>
                                                     </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="is_discounted" class="control-label mb-1">Is Discounted</label>
                                                        <select id="is_discounted" name="is_discounted" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                            @if($is_discounted == 1)
                                                            <option value="1" selected>Yes</option>
                                                            <option value="0">No</option>
                                                            @else
                                                            <option value="1" >Yes</option>
                                                            <option value="0" selected>No</option>
                                                            @endif
                                                        </select>
                                                     </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="short_desc" class="control-label mb-1">Short Description of product</label>
                                                <textarea id="short_desc" name="short_desc" type="text" class="form-control" >
                                                    {{ $short_desc }}
                                                </textarea>
                                               
                                            </div>

                                             <div class="form-group">
                                                <label for="desc" class="control-label mb-1">Long Description of product</label>
                                                <textarea id="desc" name="desc" type="text" class="form-control"  rows="5">
                                                    {{ $desc }}
                                                </textarea>
                                               
                                            </div>

                                              <div class="form-group">
                                                <label for="keywords" class="control-label mb-1">keywords</label>
                                                <textarea id="keywords" name="keywords" type="text" class="form-control" >
                                                    {{ $keywords }}
                                                </textarea>
                                               
                                            </div>

                                              <div class="form-group">
                                                <label for="technical_specs" class="control-label mb-1">Technical Specs</label>
                                                <textarea id="technical_specs" name="technical_specs" type="text" class="form-control" >
                                                    {{ $technical_specs }}
                                                </textarea>
                                               
                                            </div>

                                              <div class="form-group">
                                                <label for="uses" class="control-label mb-1">Uses</label>
                                                <textarea id="uses" name="uses" type="text" class="form-control" >
                                                    {{ $uses }}
                                                </textarea>
                                               
                                            </div>

                                            <div class="form-group">
                                                <label for="warranty" class="control-label mb-1">Warranty</label>
                                                <textarea id="warranty" name="warranty" type="text" class="form-control" >
                                                    {{ $warranty }}
                                                </textarea>
                                               
                                            </div>



                                    <div >
                                    @php
                                        $loop_count_num=1;
                                    @endphp

                                    @foreach($product_imagesArr as $key=>$val)

                                    <?php

                                        $loop_count_prev=$loop_count_num;
                                        $pIArr = (array)$val;

                                    ?>
                                    <div class="card" >
                                    <div class="card-header">Product Images</div>
                                    <div class="card-body" id="product_images_box">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Images</h3>
                                            <input id="piid" name="piid[]" type="hidden" class="form-control " value="{{ $pIArr['id'] }}" >
                                        </div>
                                        <hr>
                                          

                                             <div class="row" >
                                                <div class="col-6 product_images_{{$loop_count_num++}}" id="product_images_box">
                                                     <div class="form-group">
                                                        <label for="images" class="control-label mb-1">Image</label>
                                                        <input id="images" name="images[]" type="file" class="form-control" aria-required="false" aria-invalid="false" value=" " {{ $image_required }}>

                                                    </div>
                                                </div>

                                                    <div class="col-6">
                                                        <div class="form-group text-center">

                            @if($pIArr['images'] == '' )
                            <img src="{{ asset('storage/media/dummy.jpg') }}" class="img-thumbnail " width="50%" height="150px">
                            @else
                            <img src="{{ asset('storage/media/'.$pIArr['images']) }}" class="img-thumbnail " width="50%" height="150px">
                            @endif
                                                    </div>

                                                     @error('images')
                                                        <div class="alert alert-info">
                                                         {{ $message }}
                                                         </div>
                                                      @enderror
                                                  </div>
                                                
                                               
                                            </div>






                                               <div class="row" >
                                                <div class="col-12 mb-3" >
                                                    @if($loop_count_num == 2)

                                                    <button type="button" class="btn btn-outline-success btn-lg btn-block" onclick="add_image_more()">
                                                     <i class="fa fa-plus"></i>&nbsp; Add Images</button>

                                                     @else

                                                     <a href="{{ url('admin/product/product_images_delete') }}/{{ $pIArr['id'] }}/{{ $id }}">
                                                         <button type="button" class="btn btn-outline-danger btn-lg btn-block" {{-- onclick="remove_more({{ $loop_count_prev }})" --}} >
                                                        <i class="fa fa-minus"></i>&nbsp; Remove Images</button>
                                                     </a>

                                                     @endif

                                                </div>
                                               
                                            </div>


                                           

                                          
                                       
                                    </div>
                                </div>

                                @endforeach

                                </div>



                                            {{-- <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">Name on card</label>
                                                <input id="cc-name" name="cc-name" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                                <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div> --}}
                                          {{--   <div class="form-group">
                                                <label for="cc-number" class="control-label mb-1">Card number</label>
                                                <input id="cc-number" name="cc-number" type="tel" class="form-control cc-number identified visa" value="" data-val="true" data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number" autocomplete="cc-number">
                                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                                            </div> --}}
                                           {{--  <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Expiration</label>
                                                        <input id="cc-exp" name="cc-exp" type="tel" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="MM / YY" autocomplete="cc-exp">
                                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="x_card_code" class="control-label mb-1">Security code</label>
                                                    <div class="input-group">
                                                        <input id="x_card_code" name="x_card_code" type="tel" class="form-control cc-cvc" value="" data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" autocomplete="off">

                                                    </div>
                                                </div>
                                            </div> --}}
                                <div id="product_attr_box">
                                    @php
                                        $loop_count_num=1
                                    @endphp

                                    @foreach($product_attrArr as $key=>$val)

                                    <?php
                                        $loop_count_prev=$loop_count_num;
                                        $pAArr = (array)$val;
                                    ?>
                                    <div class="card" id="product_attr_{{$loop_count_num++}}">
                                    <div class="card-header">Product Attributes</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Attributes</h3>
                                            <input id="paid" name="paid[]" type="hidden" class="form-control " value="{{ $pAArr['id'] }}" >
                                        </div>
                                        <hr>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="sku" class="control-label mb-1">SKU</label>
                                                        <input id="sku" name="sku[]" type="text" class="form-control " value="{{ $pAArr['sku'] }}" >
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="mpr" class="control-label mb-1">MRP</label>
                                                    <div class="input-group">
                                                        <input id="mrp" name="mrp[]" type="text" class="form-control" value="{{ $pAArr['mrp'] }}">

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="price" class="control-label mb-1">Price</label>
                                                        <input id="price" name="price[]" type="text" class="form-control " value="{{ $pAArr['price'] }}" >
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="qty" class="control-label mb-1">Quantity</label>
                                                    <div class="input-group">
                                                        <input id="qty" name="qty[]" type="text" class="form-control " value="{{ $pAArr['qty'] }}">

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                <label for="size" class="control-label mb-1">Size</label>
                                                
                                                <select id="size" name="size[]" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                        <option value="">Select Size</option>
                                                    @foreach($size as $list)
                                                       @if($pAArr['size_id'] == $list->id )
                                                        <option value="{{ $list->id }}" selected>
                                                           {{ $list->size }}
                                                        </option>
                                                        @else
                                                        <option value="{{ $list->id }}">
                                                           {{ $list->size }}
                                                        </option>
                                                        @endif
                                                    @endforeach
                                                </select>

                                            </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                <label for="color" class="control-label mb-1">Color</label>
                                                
                                                <select id="color" name="color[]" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                    <option value="">Select color</option>
                                                    @foreach($color as $list)
                                                       @if($pAArr['color_id'] == $list->id )
                                                        <option value="{{ $list->id }}" selected>
                                                           {{ $list->color }}
                                                        </option>
                                                        @else
                                                        <option value="{{ $list->id }}">
                                                           {{ $list->color }}
                                                        </option>
                                                        @endif
                                                    @endforeach
                                                </select>

                                            </div>
                                                </div>
                                            </div>

                                             <div class="row">
                                                <div class="col-6">
                                                     <div class="form-group">
                                                        <label for="attr_image" class="control-label mb-1">Image</label>
                                                        <input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="false" aria-invalid="false" value=" " {{ $image_required }}>

                                                    </div>
                                                </div>

                                                    <div class="col-6">
                                                        <div class="form-group text-center">

                            @if($pAArr['attr_image'] == '' | $pAArr['attr_image'] == 'test')
                            <img src="{{ asset('storage/media/dummy.jpg') }}" class="img-thumbnail " width="50%" height="150px">
                            @else
                            <img src="{{ asset('storage/media/'.$pAArr['attr_image']) }}" class="img-thumbnail " width="50%" height="150px">
                            @endif
                                                    </div>

                                                     @error('attr_image')
                                                        <div class="alert alert-info">
                                                         {{ $message }}
                                                         </div>
                                                      @enderror
                                                  </div>
                                                
                                               
                                            </div>

                                               <div class="row">
                                                <div class="col-6">
                                                    @if($loop_count_num == 2)

                                                    <button type="button" class="btn btn-outline-success btn-lg btn-block" onclick="add_more()">
                                                     <i class="fa fa-plus"></i>&nbsp; Add Attributes</button>

                                                     @else

                                                     <a href="{{ url('admin/product/product_attr_delete') }}/{{ $pAArr['id'] }}/{{ $id }}">
                                                         <button type="button" class="btn btn-outline-danger btn-lg btn-block" {{-- onclick="remove_more({{ $loop_count_prev }})" --}} >
                                                        <i class="fa fa-minus"></i>&nbsp; Remove Attributes</button>
                                                     </a>

                                                     @endif

                                                </div>
                                               
                                            </div>

                                          
                                       
                                    </div>
                                </div>

                                @endforeach

                                </div>
                                    





                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <i class="fa fa-lock fa-lg"></i>&nbsp;
                                                    <span id="payment-button-amount">Add product</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                            </div>

                                            <input type="hidden" name="id" value="{{ $id }}">
                                        </form>
                                    </div>
                                </div>
            </div>
           
            <!-- END DATA TABLE-->
    </div>

    <script>

        var loop_count = 1;
        
        function add_more(){

            loop_count++;

            var html = '<input id="paid" name="paid[]" type="text" class="form-control "><div class="card" id="product_attr_'+loop_count+'"><div class="card-header">Product Attributes</div><div class="card-body"><div class="card-title"><h3 class="text-center title-2">Attributes</h3><hr>';

            html+= ' <div class="row"> <div class="col-6"> <div class="form-group"> <label for="sku" class="control-label mb-1">SKU</label> <input id="sku" name="sku[]" type="text" class="form-control " value="" > </div></div><div class="col-6"> <label for="mpr" class="control-label mb-1">MRP</label> <div class="input-group"> <input id="mrp" name="mrp[]" type="text" class="form-control" value=""> </div></div></div>';

            html+= '<div class="row"> <div class="col-6"> <div class="form-group"> <label for="price" class="control-label mb-1">Price</label> <input id="price" name="price[]" type="text" class="form-control " value="" > </div></div><div class="col-6"> <label for="qty" class="control-label mb-1">Quantity</label> <div class="input-group"> <input id="qty" name="qty[]" type="text" class="form-control " value=""> </div></div></div>';

            html+= '<div class="row"> <div class="col-6"> <div class="form-group"> <label for="size" class="control-label mb-1">Size</label> <select id="size" name="size[]" type="text" class="form-control" aria-required="true" aria-invalid="false" > <option value="">Select Size</option> @foreach($size as $list) <option value="{{$list->id}}">{{$list->size}}</option> @endforeach </select> </div></div><div class="col-6"> <div class="form-group"> <label for="color" class="control-label mb-1">Color</label> <select id="color" name="color[]" type="text" class="form-control" aria-required="true" aria-invalid="false" > <option value="">Select color</option> @foreach($color as $list) <option value="{{$list->id}}">{{$list->color}}</option> @endforeach </select> </div></div></div>';

            html+= '<div class="row"> <div class="col-12"> <div class="form-group"> <label for="attr_image" class="control-label mb-1">Image</label> <input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="false" aria-invalid="false" value=" "{{$image_required}}> </div>@error('attr_image') <div class="alert alert-info">{{$message}}</div>@enderror </div></div>';

            html+= '<div class="row"> <div class="col-6"> <button type="button" class="btn btn-outline-danger btn-lg btn-block" onclick=remove_more("'+loop_count+'")> <i class="fa fa-minus"></i>&nbsp; Remove Attributes </button> </div></div>';


             html+='</div></div></div>';

            jQuery('#product_attr_box').append(html)
 
        }

        function remove_more(loop_count){

                jQuery('#product_attr_'+loop_count).remove();
        }



        var loop_image_count = 1;
        function add_image_more(){
            loop_image_count++; 

            var html = '<input id="piid" name="piid[]" type="hidden" class="form-control " value=""><div class="row product_images_'+loop_image_count+'"> <div class="col-6 " > <div class="form-group"> <label for="images" class="control-label mb-1">Image</label> <input id="images" name="images[]" type="file" class="form-control" aria-required="false" aria-invalid="false" value=" "{{$image_required}}> </div></div><div class="col-6"> <div class="form-group text-center"> @if($pIArr['images']=='' ) <img src="{{asset('storage/media/dummy.jpg')}}" class="img-thumbnail " width="50%" height="150px"> @else <img src="{{asset('storage/media/'.$pIArr['images'])}}" class="img-thumbnail " width="50%" height="150px"> @endif </div>@error('images') <div class="alert alert-info">{{$message}}</div>@enderror </div></div>'

            html+= '<div class="row mb-3 product_images_'+loop_image_count+'"> <div class="col-12"> <button type="button" class="btn btn-outline-danger btn-lg btn-block" onclick=remove_image_more("'+loop_image_count+'")> <i class="fa fa-minus"></i>&nbsp; Remove Images </button> </div></div>';

            jQuery('#product_images_box').append(html)

        }

        function remove_image_more(loop_image_count){

                jQuery('.product_images_'+loop_image_count).remove();
        }

      

    </script>


    <script>

            CKEDITOR.replace( 'technical_specs' );
            
            CKEDITOR.replace( 'desc' );

            CKEDITOR.replace( 'short_desc' );

            CKEDITOR.replace( 'warranty' );

            CKEDITOR.replace( 'uses' );

            CKEDITOR.replace( 'keywords' );

            

    </script>


@endsection