@extends('admin/layout')
@section('page_title','Manage brand')
@section('brand_selected','active')
@section('container')


@if( $id>0 )
    {{ $image_required = "" }}
@else
    {{ $image_required = "required" }}
@endif


	<h2 class="ml-3">Manage brand</h2>

	<div class="col-md-12 mt-4">
        
		<a href="{{ url('admin/brand/') }}">
			<button type="button" class="btn btn-danger btn-lg btn-block mb-4">
				Back To brand	
			</button>
		</a>
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                            
                                <div class="card">
                                    <div class="card-header">Add brand</div>
                                    <div class="card-body">
                                        {{-- <div class="card-title">
                                            <h3 class="text-center title-2">Pay Invoice</h3>
                                        </div>
                                        <hr> --}}
                                        <form action="{{ route('brand.manage_brand_process') }}" method="post" enctype="multipart/form-data">
                                            @csrf


                                            <div class="form-group">
                                                <label for="brand" class="control-label mb-1">Brand</label>
                                                <input id="brand" name="brand" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $brand }}" >
                                            </div>
                                            
                                                
                                            @error('brand')
                                                <div class="alert alert-info">
                                                 {{ $message }}
                                                 </div>
                                            @enderror


                                            <div class="form-group">
                                                <label for="image" class="control-label mb-1">Image</label>
                                                <input id="image" name="image" type="file" class="form-control" aria-required="false" aria-invalid="false" value="{{ $image }}" {{ $image_required }}>
                                            </div>

                                             @error('image')
                                                <div class="alert alert-info">
                                                 {{ $message }}
                                                 </div>
                                              @enderror
                                                 
                                            
                                          {{--   <div class="form-group">
                                                <label for="code" class="control-label mb-1">Code</label>
                                                <input id="code" name="code" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $code }}" >
                                            </div>


                                             @error('code')
                                                <div class="alert alert-info">
                                                 {{ $message }}
                                                 </div>
                                              @enderror


                                              <div class="form-group">
                                                <label for="value" class="control-label mb-1">Value</label>
                                                <input id="value" name="value" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $value }}" >
                                            </div>


                                             @error('value')
                                                <div class="alert alert-info">
                                                 {{ $message }}
                                                 </div>
                                              @enderror --}}


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
                                                    <span id="payment-button-amount">Add Brand</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending???</span>
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