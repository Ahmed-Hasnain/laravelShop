@extends('admin/layout')
@section('page_title','Brand')
@section('brand_selected','active')
@section('container')

	<h2 class="ml-3">Brand</h2>

	<div class="col-md-12 mt-4">

        @if(session('message'))
            <div class="alert alert-info">
                {{ session('message') }}  
            </div>
        @endif
        
		<a href="{{ url('admin/brand/manage_brand') }}">
			<button type="button" class="btn btn-danger btn-lg btn-block mb-4">
				Add Brand	
			</button>
		</a>
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Brand</th>
                            <th>Status</th>
                            <th>Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brand as $brand_child)
                        <tr>
                            <td>{{ $brand_child->id }}</td>
                            <td>{{ $brand_child->brand }}</td>
                            <td>{{ $brand_child->status }}</td>
                            
                            <td> 

                                    <a href="{{ url('admin/brand/manage_brand/') }}/{{ $brand_child->id }}"><button type="button" class="    btn btn-success btn-sm">Edit</button>
                                    </a> 


                                @if($brand_child->status == 1)

                                    <a href="{{ url('admin/brand/status/0') }}/{{ $brand_child->id }}"><button type="button" class="    btn btn-primary btn-sm">Active</button>
                                    </a> 

                                @elseif($brand_child->status == 0)

                                    <a href="{{ url('admin/brand/status/1') }}/{{ $brand_child->id }}"><button type="button" class="    btn btn-warning btn-sm">Deactive</button>
                                    </a> 

                                @endif


                                    <a href="{{ url('admin/brand/delete') }}/{{ $brand_child->id }}"><button type="button" class="    btn btn-danger btn-sm">Delete</button>
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