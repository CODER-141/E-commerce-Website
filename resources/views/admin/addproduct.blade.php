@extends('admin.maindesign')

@section('add_product')

@if(session('product_message'))
<div style="margin-bottom:10px; color:black; background-color:green; padding:10px; border-radius:5px;">
    {{ session('product_message') }}
</div> 

@endif

<div class="container-fluid" >

    <form action="{{ route('admin.postaddproduct') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="product_title" placeholder="Enter Product Title here !"> <br> <br>
        <textarea name="product_description" style="width: 300px; height: 200px;" placeholder="Description!..."></textarea> <br> <br>
        <input type="number" name="product_quantity" placeholder="Enter Product Quantity here !"> <br> <br>
        <input type="number" name="product_price" placeholder="Enter Product Price here !"> <br> <br>
        <input type="file" name="product_image"> <br> <br>
        <select name="product_category">

            @foreach ( $categories as $category)
            <option value="{{ $category->category }}">{{ $category->category }}</option>                
            @endforeach

        </select><lable>Select A Category</lable> <br> <br>
        <input type="submit" name="submit" value="Add Product"> <br> <br>
    </form>
</div>

@endsection