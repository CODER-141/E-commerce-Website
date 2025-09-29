@extends('admin.maindesign')

@section('view_category')

<table style="width:100%; border-collapse:collapse; font-family:Arial, sans-serif;">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th style="padding: 12px; text-align:left; border-bottom:1px solid #add;">Category ID</th>
            <th style="padding: 12px; text-align:left; border-bottom:1px solid #add;">Category Name</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $categoryies as $category )
        <tr style="border-bottom: 1px solid #add;">
            <td style="padding: 12px;"> {{  $category->id }}</td>
            <td style="padding: 12px;">{{ $category->category }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection