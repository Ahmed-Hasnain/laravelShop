@extends('admin/layout')
@section('page_title','Color')
@section('color_selected','active')
@section('container')

	<h2 class="ml-3">Color</h2>

	<div class="col-md-12 mt-4">

        @if(session('message'))
            <div class="alert alert-info">
                {{ session('message') }}  
            </div>
        @endif
        
		<a href="{{ url('admin/color/manage_color') }}">
			<button type="button" class="btn btn-danger btn-lg btn-block mb-4">
				Add Color	
			</button>
		</a>
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>color</th>
                            <th>Status</th>
                            <th>Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($color as $color_child)
                        <tr>
                            <td>{{ $color_child->id }}</td>
                            <td>{{ $color_child->color }}</td>
                            <td>{{ $color_child->status }}</td>
                            
                            <td> 

                                    <a href="{{ url('admin/color/manage_color/') }}/{{ $color_child->id }}"><button type="button" class="    btn btn-success btn-sm">Edit</button>
                                    </a> 


                                @if($color_child->status == 1)

                                    <a href="{{ url('admin/color/status/0') }}/{{ $color_child->id }}"><button type="button" class="    btn btn-primary btn-sm">Active</button>
                                    </a> 

                                @elseif($color_child->status == 0)

                                    <a href="{{ url('admin/color/status/1') }}/{{ $color_child->id }}"><button type="button" class="    btn btn-warning btn-sm">Deactive</button>
                                    </a> 

                                @endif


                                    <a href="{{ url('admin/color/delete') }}/{{ $color_child->id }}"><button type="button" class="    btn btn-danger btn-sm">Delete</button>
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