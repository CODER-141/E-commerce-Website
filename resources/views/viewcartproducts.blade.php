@extends('maindesign')

@section('viewcart_products')

<div style="max-width:1000px; margin:0 auto;padding:20px;">
<table style="width:100%; border-collapse:collapse; font-family:Arial, sans-serif;">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th style="padding: 12px; text-align:left; border-bottom:1px solid #add;">Product Title</th>
            <th style="padding: 12px; text-align:left; border-bottom:1px solid #add;">Product Prices</th>
            <th style="padding: 12px; text-align:left; border-bottom:1px solid #add;">Product Image</th>
            <th style="padding: 12px; text-align:left; border-bottom:1px solid #add;">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $price = 0;
        @endphp
        @foreach ( $cart as $cart_product )
        <tr style="border-bottom: 1px solid #add;">
            <td style="padding: 12px;"> {{ $cart_product->product->product_title }}</td>
            <td style="padding: 12px;"> {{ $cart_product->product->product_price }}</td>
            <td style="padding: 12px;">
                <img style="width: 150px;" src="{{ asset('products/'.$cart_product->product->product_image) }}">
            </td>
            <td style="padding:12px;"><a href="{{ route('removecartproduct', $cart_product->id) }}">Remove</a></td>
        </tr>
        @php
            $price = $price + $cart_product->product->product_price;
        @endphp
        @endforeach
        <tr style="border-bottom: 1px solid #add; background-color:#f2f2f2;">
            <td style="padding: 12px; font-weight: bold;"> Total price :</td>
            <td style="padding: 12px;">{{ $price }}</td>
            <td style="padding: 12px;"></td>
            <td style="padding: 12px;"></td>
        </tr>
    </tbody>
</table>


@if (session('confirm_order'))
<div style="margin-bottom:10px; color:black; background-color:green; padding:10px; border-radius:5px;">
    {{ session('confirm_order') }}
</div>
@endif

    <form action="{{ route('confirm_order') }}" method="POST" style="margin-top: 20px;">
        @csrf
        <input type="text" name="receiver_address" id="" placeholder="Enter your Address" required> <br><br>
        <input type="text" name="receiver_phone" id="" placeholder="Enter your Phone Number" required> <br><br>
        <input class="btn btn-primary" type="submit" name="submit" value="Confirm Order"><br><br>
    </form>

</div>
@endsection