@extends('admin/layout')
@section('page_title','Customer Details')
@section('customer_selected','active')
@section('container')

	<h2 class="ml-3">Customer</h2>

	<div class="col-md-12 mt-4">

       
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                   <thead>
                       <tr>
                           <th>Field</th>
                           <th>Value</th>
                       </tr>
                   </thead>
                    <tbody>
                       <tr>
                           <td class="font-weight-bold">Name</td>
                           <td>{{ $customer_list->name }}</td>
                       </tr>
                       <tr>
                           <td class="font-weight-bold">email</td>
                           <td>{{ $customer_list->email }}</td>
                       </tr>
                        <tr>
                           <td class="font-weight-bold">Mobile</td>
                           <td>{{ $customer_list->mobile }}</td>
                       </tr>
                        <tr>
                           <td class="font-weight-bold">Address</td>
                           <td>{{ $customer_list->address }}</td>
                       </tr>
                        <tr>
                           <td class="font-weight-bold">City</td>
                           <td>{{ $customer_list->city }}</td>
                       </tr>
                        <tr>
                           <td class="font-weight-bold">State</td>
                           <td>{{ $customer_list->state }}</td>
                       </tr>
                        <tr>
                           <td class="font-weight-bold">Zip</td>
                           <td>{{ $customer_list->zip }}</td>
                       </tr>
                       <tr>
                           <td class="font-weight-bold">Company</td>
                           <td>{{ $customer_list->company }}</td>
                       </tr>
                       <tr>
                           <td class="font-weight-bold">GSTin</td>
                           <td>{{ $customer_list->gstin }}</td>
                       </tr>
                       <tr>
                           <td class="font-weight-bold">Customer Created At</td>
                           <td>{{ $customer_list->created_at }}</td>
                       </tr>
                       <tr>
                           <td class="font-weight-bold">Customer Updated At</td>
                           <td>{{ \Carbon\Carbon::parse($customer_list->updated_at)->format('d-m-Y h:i:s') }}</td>
                       </tr>
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>

@endsection