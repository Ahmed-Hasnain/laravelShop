@extends('admin/layout')
@section('page_title','Categories')
@section('category_selected','active')
@section('container')

	<h2 class="ml-3">CATEGORIES</h2>

	<div class="col-md-12 mt-4">

        @if(session('message'))
            <div class="alert alert-info">
                {{ session('message') }}  
            </div>
        @endif
        
		<a href="{{ url('admin/category/manage_category') }}">
			<button type="button" class="btn btn-danger btn-lg btn-block mb-4">
				Add Category	
			</button>
		</a>
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Category Name</th>
                            <th>Category Slug</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>{{ $category->category_slug }}</td>
                            <td> 
                                    <a href="{{ url('admin/category/manage_category/') }}/{{ $category->id }}"><button type="button" class="btn btn-success btn-sm">Edit</button></a>

                                @if($category->status == 1)

                                    <a href="{{ url('admin/category/status/0') }}/{{ $category->id }}"><button type="button" class="btn btn-primary btn-sm">Active</button></a>

                                @elseif($category->status == 0)

                                    <a href="{{ url('admin/category/status/1') }}/{{ $category->id }}"><button type="button" class="btn btn-warning btn-sm">Deactive</button></a>

                                @endif

                                    <a href="{{ url('admin/category/delete') }}/{{ $category->id }}"><button type="button" class="btn btn-danger btn-sm">Delete</button></a> 
                            </td>
                        </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>

@endsection