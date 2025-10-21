<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
</head>
<body>
    <div>
        Customer Name           :{{ $data->user->name }} <br>
        Customer Email          :{{ $data->user->email }} <br>
        Customer Address        :{{ $data->receiver_address }} <br>
        Customer Phone Number   :{{ $data->receiver_phone }} <br>
        Product Name            :{{ $data->product->product_title }} <br>
        Product Price           :{{ $data->product->product_price }} <br>
    </div>
        
</body>
</html>