@extends('admin.maindesign')

<base href='/public'>
@section('update_product')

@if(session('productupdate_message'))
<div style="margin-bottom:10px; color:black; background-color:green; padding:10px; border-radius:5px;">
    {{ session('productupdate_message') }}
</div> 

@endif

<div class="container-fluid" >

    <form action="{{ route('admin.postupdateproduct',$product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="product_title" value="{{ $product->product_title }}" > <br> <br>
        <textarea name="product_description" style="width: 300px; height: 200px;">{{ $product->product_description }}</textarea> <br> <br>
        <input type="number" name="product_quantity" value="{{ $product->product_quantity }}"> <br> <br>
        <input type="number" name="product_price" value="{{ $product->product_price }}"> <br> <br>

        <label>Old image</label><br>
        <img style="width: 150px;" src="{{ asset('products/'.$product->product_image) }}" > <br> <br>
        <lable> Add new image here!</lable><br>
        <input type="file" name="product_image"><br> <br>

        <select name="product_category">
            <option value="{{ $product->product_category }}">
                    {{ $product->product_category }}
            </option>
            @foreach ( $categories as $category)
            <option value="{{ $category->category }}">{{ $category->category }}</option>                
            @endforeach

        </select><lable>Select A Category</lable> <br> <br>
        <input type="submit" name="submit" value="Update Product"> <br> <br>
    </form>
</div>

@endsection