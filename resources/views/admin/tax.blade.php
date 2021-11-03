@extends('admin/layout')
@section('page_title','Tax')
@section('tax_selected','active')
@section('container')

	<h2 class="ml-3">Tax</h2>

	<div class="col-md-12 mt-4">

        @if(session('message'))
            <div class="alert alert-info">
                {{ session('message') }}  
            </div>
        @endif
        
		<a href="{{ url('admin/tax/manage_tax') }}">
			<button type="button" class="btn btn-danger btn-lg btn-block mb-4">
				Add Tax	
			</button>
		</a>
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tax Value</th>
                            <th>Description</th>
                            <th>Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tax as $tax_child)
                        <tr>
                            <td>{{ $tax_child->id }}</td>
                            <td>{{ $tax_child->tax_value }}</td>
                            <td>{{ $tax_child->tax_desc }}</td>
                            
                            <td> 

                                    <a href="{{ url('admin/tax/manage_tax/') }}/{{ $tax_child->id }}"><button type="button" class="    btn btn-success btn-sm">Edit</button>
                                    </a> 


                                @if($tax_child->status == 1)

                                    <a href="{{ url('admin/tax/status/0') }}/{{ $tax_child->id }}"><button type="button" class="    btn btn-primary btn-sm">Active</button>
                                    </a> 

                                @elseif($tax_child->status == 0)

                                    <a href="{{ url('admin/tax/status/1') }}/{{ $tax_child->id }}"><button type="button" class="    btn btn-warning btn-sm">Deactive</button>
                                    </a> 

                                @endif


                                    <a href="{{ url('admin/tax/delete') }}/{{ $tax_child->id }}"><button type="button" class="    btn btn-danger btn-sm">Delete</button>
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