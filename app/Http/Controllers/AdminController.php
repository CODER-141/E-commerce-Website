<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
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

    public function viewCategory(){
        $categoryies=Category::all();
        return view('admin.viewcategory',compact('categoryies'));
    }

    public function deleteCategory($id){
        $category=Category::findOrFail($id);

        $category->delete();
        return redirect()->back()->with('deletecategory_message','Category Delete Successfully');
    }

    public function updateCategory($id){
        $category=Category::findOrFail($id);

        return view('admin.updatecategory',compact('category'));
    }

    public function postUpdateCategory(Request $request,$id){
        $category=Category::findOrFail($id);

        $category->category=$request->category;
        $category->save();
        return redirect()->back()->with('category_updated_message','Category Updated Successfully');
    }

    public function addProduct(){
        $categories = Category::all();
        return view('admin.addproduct',compact('categories'));
    }

    // public function postAddProduct(Request $request){
    //     $product = new Product();

    //     $product -> product_title =$request -> product_title;
    //     $product -> product_description =$request -> product_description;
    //     $product -> product_quantity =$request -> product_quantity;
    //     $product -> product_price =$request -> product_price;

    //     $image=$request->product_image;
    //     if($image){
    //         $imagename = time().'.'.$image->getClientOriginalExtension();
    //         $product->product_image=$imagename;
    //     }

    //     $product -> product_category =$request -> product_category;
    //     $product -> save();

    //     if($image && $product->save()){
    //         $request->product_image->move('products',$imagename);
    //     }
    //     return redirect()->back()->with('product_message','Product Added Successfullt!');
    // }

    public function postAddProduct(Request $request)
{
    $product = new Product();

    // Set product details
    $product->product_title = $request->product_title;
    $product->product_description = $request->product_description;
    $product->product_quantity = $request->product_quantity;
    $product->product_price = $request->product_price;
    $product->product_category = $request->product_category;

    // Handle image upload and watermark
    if ($request->hasFile('product_image')) {
        $image = $request->file('product_image');

        // ✅ Call the watermark function instead of normal move()
        $imagename = $this->storeImage($image);

        // Save the image name in the database
        $product->product_image = $imagename;
    }

    // Save the product
    $product->save();

    return redirect()->back()->with('product_message', 'Product Added Successfully!');
}


    // ✅ New function to handle image storage with watermark
    private function storeImage($image)
{
    $imageName = time() . random_int(1, 100) . '.' . $image->extension();
    $imagePath = public_path('products/') . $imageName;

    // Move the uploaded image to /public/products/
    $image->move(public_path('products/'), $imageName);

    // Load the image into PHP memory
    $img = imagecreatefromstring(file_get_contents($imagePath));

    // Watermark settings
    $font = 10; // font size
    $white = imagecolorallocate($img, 255, 0, 0); // white color
    $text = "Giftshop.com"; // watermark text

    // Calculate position (bottom-right)
    $textX = imagesx($img) - (imagefontwidth($font) * strlen($text)) - 10;
    $textY = imagesy($img) - imagefontheight($font) - 10;

    // Add text
    imagestring($img, $font, $textX, $textY, $text, $white);

    // Save final image (overwrite original)
    imagejpeg($img, $imagePath);

    // Free memory
    imagedestroy($img);

    return $imageName;
}

    public function viewProduct(){
        //this paginate(1) 1-> show the how many items must show in one page
        $products = Product::paginate(2);
        return view ('admin.viewproduct',compact('products'));
    }

    public function deleteProduct($id){
        $product = Product::findOrFail($id);
        //$product->delete(); if you don't want to delete image when you delete the product use this 
        // when product is delete it image also deleted from this 
        $image_path = public_path('products/'.$product->product_image);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $product->delete(); 
        return redirect()->back()->with('deleteproduct_message','Product Deleted Successfully!');
    }

    public function updateProduct($id){
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.updateproduct',compact('product','categories'));
    }

    public function postUpdateProduct(Request $request,$id){
        $product = Product::findOrFail($id);

        $product -> product_title =$request -> product_title;
        $product -> product_description =$request -> product_description;
        $product -> product_quantity =$request -> product_quantity;
        $product -> product_price =$request -> product_price;

        $image=$request->product_image;
        if($image){
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $product->product_image=$imagename;
        }

        $product -> product_category =$request -> product_category;
        $product -> save();

        if($image && $product->save()){
            $request->product_image->move('products',$imagename);
        }
        return redirect()->back()->with('productupdate_message','Product updated Successfullt!');
    }

    public function searchProduct(Request $request){
        $products=Product::where('product_title','LIKE','%'.$request->search.'%')
                        ->orwhere('product_description','LIKE','%'.$request->search.'%')
                        ->orwhere('product_category','LIKE','%'.$request->search.'%')
                        ->paginate(3);

        return view ('admin.viewproduct',compact('products'));
    }

    public function vieworders(){
        $orders = Order::all();
        return view('admin.vieworders',compact('orders'));
    }
}

