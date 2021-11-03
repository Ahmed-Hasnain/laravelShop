@extends('admin/layout')
@section('page_title','customer')
@section('customer_selected','active')
@section('container')

	<h2 class="ml-3">Customer</h2>

	<div class="col-md-12 mt-4">

        @if(session('message'))
            <div class="alert alert-info">
                {{ session('message') }}  
            </div>
        @endif
        
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Status</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customer as $customer_child)
                        <tr>
                            <td>{{ $customer_child->id }}</td>
                            <td>{{ $customer_child->name }}</td>
                            <td>{{ $customer_child->email }}</td>
                            <td>{{ $customer_child->mobile }}</td>
                            <td>{{ $customer_child->status }}</td>
                            
                            <td> 

                                    <a href="{{ url('admin/customer/show/') }}/{{ $customer_child->id }}"><button type="button" class="    btn btn-success btn-sm">View</button> 
                                    </a> 


                                @if($customer_child->status == 1)

                                    <a href="{{ url('admin/customer/status/0') }}/{{ $customer_child->id }}"><button type="button" class="    btn btn-primary btn-sm">Active</button>
                                    </a> 

                                @elseif($customer_child->status == 0)

                                    <a href="{{ url('admin/customer/status/1') }}/{{ $customer_child->id }}"><button type="button" class="    btn btn-warning btn-sm">Deactive</button>
                                    </a> 

                                @endif

                                    
                            </td>
                        </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>

@endsection