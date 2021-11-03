@extends('admin/layout')
@section('page_title','Product')
@section('product_selected','active')
@section('container')

	<h2 class="ml-3">Product</h2>

	<div class="col-md-12 mt-4">

        @if(session('message'))
            <div class="alert alert-info">
                {{ session('message') }}  
            </div>
        @endif
        
		<a href="{{ url('admin/product/manage_product') }}">
			<button type="button" class="btn btn-danger btn-lg btn-block mb-4">
				Add Product	
			</button>
		</a>
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                           {{--  <th>Image</th> --}}
                            <th>Id</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product as $product_child)
                        <tr>

                            {{-- @if($product_child->image == '')
                            <td><img src="{{ asset('storage/media/dummy.jpg') }}" class="img-thumbnail" width="70px" height="50px"></td>
                            @else
                            <td><img src="{{ asset('storage/media/'.$product_child->image) }}" class="img-thumbnail" width="70px" height="50px"></td>
                            @endif --}}
                            
                            <td>{{ $product_child->id }}</td>
                            <td>{{ $product_child->name }}</td>
                            <td>{{ $product_child->slug }}</td>
                            
                            <td> 

                                    <a href="{{ url('admin/product/manage_product/') }}/{{ $product_child->id }}"><button type="button" class="    btn btn-success btn-sm">Edit</button>
                                    </a> 


                                @if($product_child->status == 1)

                                    <a href="{{ url('admin/product/status/0') }}/{{ $product_child->id }}"><button type="button" class="    btn btn-primary btn-sm">Active</button>
                                    </a> 

                                @elseif($product_child->status == 0)

                                    <a href="{{ url('admin/product/status/1') }}/{{ $product_child->id }}"><button type="button" class="    btn btn-warning btn-sm">Deactive</button>
                                    </a> 

                                @endif


                                    <a href="{{ url('admin/product/delete') }}/{{ $product_child->id }}"><button type="button" class="    btn btn-danger btn-sm">Delete</button>
                                    </a>

                                    
                            </td>
                        </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>

@endsection