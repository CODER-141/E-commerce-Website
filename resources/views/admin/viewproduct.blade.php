@extends('admin.maindesign')

@section('view_category')

@if (session('deletecategory_message'))
<div style="margin-bottom:10px; color:black; background-color:orangered; padding:10px; border-radius:5px;">
    {{ session('deletecategory_message') }}
</div>
@endif

<table style="width:100%; border-collapse:collapse; font-family:Arial, sans-serif;">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th style="padding: 12px; text-align:left; border-bottom:1px solid #add;">Product Title</th>
            <th style="padding: 12px; text-align:left; border-bottom:1px solid #add;">Product Description</th>
            <th style="padding: 12px; text-align:left; border-bottom:1px solid #add;">Product Quantity</th>
            <th style="padding: 12px; text-align:left; border-bottom:1px solid #add;">Product Prices</th>
            <th style="padding: 12px; text-align:left; border-bottom:1px solid #add;">Product Image</th>
            <th style="padding: 12px; text-align:left; border-bottom:1px solid #add;">Product Category</th>
            <th style="padding: 12px; text-align:left; border-bottom:1px solid #add;">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $products as $product )
        <tr style="border-bottom: 1px solid #add;">
            <td style="padding: 12px;"> {{ $product->product_title }}</td>
            <td style="padding: 12px;"> {{ $product->product_description }}</td>
            <td style="padding: 12px;"> {{ $product->product_quantity }}</td>
            <td style="padding: 12px;"> {{ $product->product_price }}</td>
            <td style="padding: 12px;"> 
                <img style="width: 150px;" src="{{ asset('products/'.$product->product_image) }}">
            </td>
            <td style="padding: 12px;"> {{ $product->product_category }}</td>
            <td style="padding: 12px;">
                <a href="#" style="color: green;">Update</a>
                <a href="#"onclick="return confirm('Are you want to delete this category')">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection