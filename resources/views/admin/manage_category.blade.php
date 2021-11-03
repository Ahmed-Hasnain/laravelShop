@extends('admin/layout')
@section('page_title','Manage Categories')
@section('category_selected','active')
@section('container')

	<h2 class="ml-3">MANAGE CATEGORIES</h2>

	<div class="col-md-12 mt-4">
        
		<a href="{{ url('admin/category/') }}">
			<button type="button" class="btn btn-danger btn-lg btn-block mb-4">
				Back To category	
			</button>
		</a>
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                            
                                <div class="card">
                                    <div class="card-header">Add Category</div>
                                    <div class="card-body">
                                        {{-- <div class="card-title">
                                            <h3 class="text-center title-2">Pay Invoice</h3>
                                        </div>
                                        <hr> --}}
                                        <form action="{{ route('category.manage_category_process') }}" method="post" enctype="multipart/form-data">
                                            @csrf


                                            <div class="form-group">
                                                <label for="category" class="control-label mb-1">Category Name</label>
                                                <input id="category_name" name="category_name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $category_name }}" >
                                            </div>
                                            
                                                
                                            @error('category_name')
                                                <div class="alert alert-info">
                                                 {{ $message }}
                                                 </div>
                                            @enderror
                                                 
                                            
                                            <div class="form-group">
                                                <label for="category_slug" class="control-label mb-1">Category Slug</label>
                                                <input id="category_slug" name="category_slug" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $category_slug }}" >
                                            </div>


                                             @error('category_slug')
                                                <div class="alert alert-info">
                                                 {{ $message }}
                                                 </div>
                                              @enderror

                                              <div class="form-group">
                                                <label for="parent_category_id" class="control-label mb-1">Parent Category</label>
                                                
                                                <select id="parent_category_id" name="parent_category_id" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                        <option value="0">Select Parent Category</option>
                                                    @foreach($category as $list)
                                                        @if($parent_category_id == $list->id)
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
                                                <label for="is_home" class="control-label mb-1">Show it on Home Page</label>
                                                <input id="is_home" name="is_home" type="checkbox" class="ml-4" {{ $is_home_checked }}>
                                                

                                            </div>

                                            <div class="row">
                                                <div class="col-6">
                                                     <div class="form-group">
                                                <label for="category_image" class="control-label mb-1">Category Image</label>
                                                <input id="category_image" name="category_image" type="file" class="form-control" aria-required="false" aria-invalid="false" value="{{ $category_image }}" >
                                            </div>

                                             @error('category_image')
                                                <div class="alert alert-info">
                                                 {{ $message }}
                                                 </div>
                                              @enderror
                                                </div>

                                                <div class="col-6">
                                                     @if($category_image == '')
                            <td><img src="{{ asset('storage/media/dummy.jpg') }}" class="img-thumbnail" width="70px" height="50px"></td>
                            @else
                            <td><img src="{{ asset('storage/media/'.$category_image) }}" class="img-thumbnail" width="70px" height="50px"></td>
                            @endif
                                                </div>
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
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <i class="fa fa-lock fa-lg"></i>&nbsp;
                                                    <span id="payment-button-amount">Add Category</span>
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

@endsection