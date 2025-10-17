@extends('admin.maindesign')

@section('view_orders')

<table style="width:100%; border-collapse:collapse; font-family:Arial, sans-serif;">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th style="padding: 12px; text-align:left; border-bottom:1px solid #add;">Customer name</th>
            <th style="padding: 12px; text-align:left; border-bottom:1px solid #add;">Customer Address</th>
            <th style="padding: 12px; text-align:left; border-bottom:1px solid #add;">Customer Phone Number</th>
            <th style="padding: 12px; text-align:left; border-bottom:1px solid #add;">Product Name</th>
            <th style="padding: 12px; text-align:left; border-bottom:1px solid #add;">Product price</th>
            <th style="padding: 12px; text-align:left; border-bottom:1px solid #add;">Product image</th>
            <th style="padding: 12px; text-align:left; border-bottom:1px solid #add;">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $orders as $order )
        <tr style="border-bottom: 1px solid #add;">
            <td style="padding: 12px;"> {{ $order->user->name }}</td>
            <td style="padding: 12px;"> {{ $order->receiver_address }}</td>
            <td style="padding: 12px;"> {{ $order->receiver_phone }}</td>
            <td style="padding: 12px;"> {{ $order->product->product_title }}</td>
            <td style="padding: 12px;"> {{ $order->product->product_price }}</td>
            <td style="padding: 12px;">
                <img style="width: 150px;" src="{{ asset('products/'.$order->product->product_image) }}">
            </td>
            <td style="padding: 12px;">

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

