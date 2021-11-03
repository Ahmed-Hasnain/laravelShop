@extends('admin/layout')
@section('page_title','home_banner')
@section('home_banner_selected','active')
@section('container')

	<h2 class="ml-3">Home Banner</h2>

	<div class="col-md-12 mt-4">

        @if(session('message'))
            <div class="alert alert-info">
                {{ session('message') }}  
            </div>
        @endif
        
		<a href="{{ url('admin/home_banner/manage_home_banner') }}">
			<button type="button" class="btn btn-danger btn-lg btn-block mb-4">
				Add Home Banner	
			</button>
		</a>
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Home Banner</th>
                            <th>Status</th>
                            <th>Controls</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($home_banner as $home_banner_child)
                        <tr>
                            <td>{{ $home_banner_child->id }}</td>
                            <td>{{ $home_banner_child->heading }}</td>
                            <td>{{ $home_banner_child->status }}</td>
                            
                            <td> 

                                    <a href="{{ url('admin/home_banner/manage_home_banner/') }}/{{ $home_banner_child->id }}"><button type="button" class="    btn btn-success btn-sm">Edit</button>
                                    </a> 


                                @if($home_banner_child->status == 1)

                                    <a href="{{ url('admin/home_banner/status/0') }}/{{ $home_banner_child->id }}"><button type="button" class="    btn btn-primary btn-sm">Active</button>
                                    </a> 

                                @elseif($home_banner_child->status == 0)

                                    <a href="{{ url('admin/home_banner/status/1') }}/{{ $home_banner_child->id }}"><button type="button" class="    btn btn-warning btn-sm">Deactive</button>
                                    </a> 

                                @endif


                                    <a href="{{ url('admin/home_banner/delete') }}/{{ $home_banner_child->id }}"><button type="button" class="    btn btn-danger btn-sm">Delete</button>
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