@extends('admin.maindesign')

@section('add_category')

@if(session('category_message'))
<div style="margin-bottom:10px; color:black; background-color:green; padding:10px; border-radius:5px;">
    {{ session('category_message') }}
</div> 

@endif

<div class="container-fluid">

    <form action="{{ route('admin.postaddcategory') }}" method="POST">
        @csrf
        <input type="text" name="category" placeholder="Enter Category Name!">
        <input type="submit" name="submit" value="Add Category">
    </form>
</div>

@endsection