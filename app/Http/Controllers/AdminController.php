<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function addCategory(){
        return view('admin.addcategory');
    }
    public function postAddCategory(Request $request){
        $category= new Category();
        $category->category=$request->category;
        $category->save();
        return redirect()->back()->with('category_message','Category Added Successfully!');
    }
}
