@extends('admin.maindesign')

<base href='/public'>
@section('update_category')

@if(session('category_updated_message'))
<div style="margin-bottom:10px; color:black; background-color:green; padding:10px; border-radius:5px;">
    {{ session('category_updated_message') }}
</div> 

@endif

<div class="container-fluid">

    <form action="{{ route('admin.postupdatecategory',$category->id) }}" method="POST">
        @csrf
        <input type="text" name="category" value="{{ $category->category }}">
        <input type="submit" name="submit" value="update Category">
    </form>
</div>

@endsection