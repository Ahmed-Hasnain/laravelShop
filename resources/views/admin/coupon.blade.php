@extends('admin/layout')
@section('page_title','Coupon')
@section('coupon_selected','active')
@section('container')

	<h2 class="ml-3">coupon</h2>

	<div class="col-md-12 mt-4">

        @if(session('message'))
            <div class="alert alert-info">
                {{ session('message') }}  
            </div>
        @endif
        
		<a href="{{ url('admin/coupon/manage_coupon') }}">
			<button type="button" class="btn btn-danger btn-lg btn-block mb-4">
				Add Coupon	
			</button>
		</a>
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Code</th>
                            <th>Value</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($coupon as $coupon_child)
                        <tr>
                            <td>{{ $coupon_child->id }}</td>
                            <td>{{ $coupon_child->title }}</td>
                            <td>{{ $coupon_child->code }}</td>
                            <td>{{ $coupon_child->value }}</td>
                            <td> 

                                    <a href="{{ url('admin/coupon/manage_coupon/') }}/{{ $coupon_child->id }}"><button type="button" class="    btn btn-success btn-sm">Edit</button>
                                    </a> 


                                @if($coupon_child->status == 1)

                                    <a href="{{ url('admin/coupon/status/0') }}/{{ $coupon_child->id }}"><button type="button" class="    btn btn-primary btn-sm">Active</button>
                                    </a> 

                                @elseif($coupon_child->status == 0)

                                    <a href="{{ url('admin/coupon/status/1') }}/{{ $coupon_child->id }}"><button type="button" class="    btn btn-warning btn-sm">Deactive</button>
                                    </a> 

                                @endif


                                    <a href="{{ url('admin/coupon/delete') }}/{{ $coupon_child->id }}"><button type="button" class="    btn btn-danger btn-sm">Delete</button>
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