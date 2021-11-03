@extends('admin/layout')
@section('page_title','Order')
@section('tax_selected','active')
@section('container')

	<h2 class="ml-3">Order</h2>

	<div class="col-md-12 mt-4">

            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Customer</th>
                            <th>Order Status</th>
                            <th>Payment Type</th>
                            <th>Payment Status</th>
                            <th>Total Amount</th>
                            <th>Placed At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order as $order_child)
                        <tr>
                            <td> <a href="{{ url('/admin/order_detail') }}/{{ $order_child->id }}">{{ $order_child->id }}</a> </td>
                            <td>
                                {{ $order_child->name }}<br>
                                {{ $order_child->email }}<br>
                                {{ $order_child->mobile }}<br>
                                {{ $order_child->address }},{{ $order_child->city }},
                                {{ $order_child->state }},{{ $order_child->pincode }}
                            </td>
                            <td>{{ $order_child->order_status }}</td>
                            <td>{{ $order_child->payment_type }}</td>
                            <td>{{ $order_child->payment_status }}</td>
                            <td>{{ $order_child->total_amount }}</td>
                            <td>{{ $order_child->added_on }}</td>
                        </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>

@endsection