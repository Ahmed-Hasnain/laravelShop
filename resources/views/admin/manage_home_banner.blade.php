@extends('admin/layout')
@section('page_title','Manage Home Banner')
@section('home_banner_selected','active')
@section('container')


@if( $id>0 )
    {{ $image_required = "" }}
@else
    {{ $image_required = "required" }}
@endif


	<h2 class="ml-3">Manage Home Banner</h2>

	<div class="col-md-12 mt-4">
        
		<a href="{{ url('admin/home_banner/') }}">
			<button type="button" class="btn btn-danger btn-lg btn-block mb-4">
				Back To Home Banner	
			</button>
		</a>
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                            
                                <div class="card">
                                    <div class="card-header">Add Home Banner</div>
                                    <div class="card-body">
                                        {{-- <div class="card-title">
                                            <h3 class="text-center title-2">Pay Invoice</h3>
                                        </div>
                                        <hr> --}}
                                        <form action="{{ route('home_banner.manage_home_banner_process') }}" method="post" enctype="multipart/form-data">
                                            @csrf


                                            <div class="form-group">
                                                <label for="heading" class="control-label mb-1">Heading</label>
                                                <input id="heading" name="heading" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $heading }}" >
                                            </div>
                                            
                                                
                                            @error('heading')
                                                <div class="alert alert-info">
                                                 {{ $message }}
                                                 </div>
                                            @enderror



                                            <div class="form-group">
                                                <label for="btn_txt" class="control-label mb-1">Button Text</label>
                                                <input id="btn_txt" name="btn_txt" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $btn_txt }}" >
                                            </div>
                                            
                                                
                                            @error('btn_txt')
                                                <div class="alert alert-info">
                                                 {{ $message }}
                                                 </div>
                                            @enderror


                                            <div class="form-group">
                                                <label for="heading" class="control-label mb-1">Button Link</label>
                                                <input id="btn_link" name="btn_link" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $btn_link }}" >
                                            </div>
                                            
                                                
                                            @error('btn_link')
                                                <div class="alert alert-info">
                                                 {{ $message }}
                                                 </div>
                                            @enderror


                                            <div class="form-group">
                                                <label for="heading" class="control-label mb-1">Text 1</label>
                                                <input id="text_1" name="text_1" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $text_1 }}" >
                                            </div>
                                            
                                                
                                            @error('text_1')
                                                <div class="alert alert-info">
                                                 {{ $message }}
                                                 </div>
                                            @enderror



                                            <div class="form-group">
                                                <label for="heading" class="control-label mb-1">Text 2</label>
                                                <input id="text_2" name="text_2" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ $text_2 }}" >
                                            </div>
                                            
                                                
                                            @error('text_2')
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
                                                 
                                            
                                     
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <i class="fa fa-lock fa-lg"></i>&nbsp;
                                                    <span id="payment-button-amount">Add Home Banner</span>
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