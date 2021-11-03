@extends('admin/layout')
@section('page_title','Product Reviews')
@section('product_review_selected','active')
@section('container')

	<h2 class="ml-3">Product Reviews</h2>

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
                            <th>User</th>
                            <th>Rating</th>
                            <th>Review</th>
                            <th>Product</th>
                            <th>Added On</th>
                            <th>Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product_reviews as $review)
                        <tr>
                            <td>{{ $review->id }}</td>
                            <td>{{ $review->name }}</td>
                            <td>{{ $review->rating }}</td>
                            <td>{{ $review->review }}</td>
                            <td>{{ $review->pname }}</td>
                            <td>{{ $review->added_on }}</td>
                            
                            <td> 

                                @if($review->status == 1)

                                    <a href="{{ url('admin/product_reviews/0') }}/{{ $review->id }}"><button type="button" class="    btn btn-primary btn-sm">Active</button>
                                    </a> 

                                @elseif($review->status == 0)

                                    <a href="{{ url('admin/product_reviews/1') }}/{{ $review->id }}"><button type="button" class="    btn btn-warning btn-sm">Deactive</button>
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