@extends('admin/layout')
@section('page_title','Manage Coupon')
@section('coupon_selected','active')
@section('container')

	<h2 class="ml-3">Manage Coupon</h2>

	<div class="col-md-12 mt-4">
        
		<a href="{{ url('admin/coupon/') }}">
			<button type="button" class="btn btn-danger btn-lg btn-block mb-4">
				Back To Coupon	
			</button>
		</a>
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                            
                                <div class="card">
                                    <div class="card-header">Add Coupon</div>
                                    <div class="card-body">
                                        {{-- <div class="card-title">
                                            <h3 class="text-center title-2">Pay Invoice</h3>
                                        </div>
                                        <hr> --}}
                                        <form action="{{ route('coupon.manage_coupon_process') }}" method="post">
                                            @csrf

                                            <div class="row">
                                                <div class="col-6"> 
                                                    <div class="form-group">
                                                <label for="title" class="control-label mb-1">Title</label>
                                                <input id="title" name="title" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $title }}" >
                                            </div>
                                            
                                                
                                            @error('title')
                                                <div class="alert alert-info">
                                                 {{ $message }}
                                                 </div>
                                            @enderror
                                                </div>

                                                <div class="col-6"> 
                                                     <div class="form-group">
                                                <label for="code" class="control-label mb-1">Code</label>
                                                <input id="code" name="code" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $code }}" >
                                            </div>


                                             @error('code')
                                                <div class="alert alert-info">
                                                 {{ $message }}
                                                 </div>
                                              @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-6"> 
                                                     <div class="form-group">
                                                <label for="value" class="control-label mb-1">Value</label>
                                                <input id="value" name="value" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $value }}" >
                                            </div>


                                             @error('value')
                                                <div class="alert alert-info">
                                                 {{ $message }}
                                                 </div>
                                              @enderror
                                                </div>

                                                <div class="col-6"> 
                                                     <div class="form-group">
                                                <label for="type" class="control-label mb-1">Type</label>
                                               <select id="type" name="type" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                            @if($type == "Value")
                                                            <option value="Value" selected>Value</option>
                                                            <option value="Per">Percentage</option>
                                                            @elseif($type == "Per")
                                                            <option value="Value" >Value</option>
                                                            <option value="Per" selected>Percentage</option> 
                                                            @else
                                                            <option value="Value" >Value</option>
                                                            <option value="Per" >Percentage</option>
                                                            @endif
                                                        </select>
                                            </div>


                                             @error('type')
                                                <div class="alert alert-info">
                                                 {{ $message }}
                                                 </div>
                                              @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-6"> 
                                                     <div class="form-group">
                                                <label for="min_order_amount" class="control-label mb-1">Min Order Amount</label>
                                                <input id="min_order_amount" name="min_order_amount" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $min_order_amount }}" >
                                            </div>


                                             @error('min_order_amount')
                                                <div class="alert alert-info">
                                                 {{ $message }}
                                                 </div>
                                              @enderror
                                                </div>

                                                <div class="col-6"> 
                                                     <div class="form-group">
                                                <label for="is_one_time" class="control-label mb-1">Is One Time</label>
                                               <select id="is_one_time" name="is_one_time" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                            @if($is_one_time == 1)
                                                            <option value="1" selected>Yes</option>
                                                            <option value="0">No</option>
                                                            @else
                                                            <option value="1" >Yes</option>
                                                            <option value="0" selected>No</option>
                                                            @endif
                                                        </select>
                                            </div>


                                             @error('value')
                                                <div class="alert alert-info">
                                                 {{ $message }}
                                                 </div>
                                              @enderror
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