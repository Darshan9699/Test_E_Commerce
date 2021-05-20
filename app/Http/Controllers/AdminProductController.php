<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('admin.Products.index')->with('Products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allCategories = Category::all();
        return view('admin.Products.add')->with('allCategories',$allCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  dd($request->featured);
        $request->validate([
            'product_name' => 'required|unique:products,product_name',
            'slug'=> 'required|unique:products,slug',
            'details' => 'required',
            'product_price' => 'required',
            'product_description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName ();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename. '_'. time().'.'.$extension;
            $request->image->move(public_path('images'), $fileNameToStore);
        } 

        $product = new Product();
        $product->product_name = $request->product_name;
        $product->slug = $request->slug;
        $product->details = $request->details;
        $product->product_pirce = $request->product_price;
        $product->product_description = $request->product_description;
        $product->image = $fileNameToStore;
        // if($request->featured == "on"){
        //     $var = true;
        // } else {
        //     $var = false;
        // }
        $product->featured = $request->has('featured');
        $product->save();

        //  //enter to category
        // if($request->category) {
        //     foreach($request->category as $category){
        //         $id = $product->id;
        //         CategoryProduct::create([
        //             'product_id' => $id,
        //             'category_id'=> $category
        //         ]);
        //     }
        // }

        // $imageName = time().'.'.$request->image->extension();  
        // $request->image->move(public_path('images'), $imageName);

        return redirect()->route('admin.products')->with('success_message','your Product is create succesfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id',$id)->get();
        return view('admin.Products.productview')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('id',$id)->first();
        $allCategories = Category::all();

        $product = Product::find($id);
        $categoriesForProduct = $product->categories()->get();

        return view('admin.Products.edit')->with([
            'products' => $product,
            'allCategories' => $allCategories,
            'categoriesForProduct' => $categoriesForProduct
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required',
            'slug'=> 'required',
            'details' => 'required',
            'product_price' => 'required',
            'product_description' => 'required',
            'featured' => 'nullable|boolean',
        ]);

            if ($request->hasFile('image')) {
                $filenameWithExt = $request->file('image')->getClientOriginalName ();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('image')->getClientOriginalExtension();
                $fileNameToStore = $filename. '_'. time().'.'.$extension;
                $request->image->move(public_path('images'), $fileNameToStore);
            } 
            
        $product = Product::find($id);
        $product->product_name = $request->product_name;
        $product->slug = $request->slug;
        $product->details = $request->details;
        $product->product_pirce = $request->product_price;
        $product->product_description = $request->product_description;
        if($request->hasFile('image')){
            $product->image = $fileNameToStore;
        } else {
            $product->image = $product->image;
        }
        $product->featured = $request->has('featured');
        $product->save();

        //try to store Category Products

        CategoryProduct::where('product_id',$id)->delete();

        if($request->category) {
            foreach($request->category as $category){
                CategoryProduct::create([
                    'product_id' => $id,
                    'category_id'=> $category
                ]);
            }
        }
        return redirect()->route('admin.products')->with('success_message','your Product is Update succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('admin.products')->with('success_message','Your Product is Delete Successfully');
    }

    public function changeStatus(Request $request)
    {
            // dd('Hello worlds');
            $product = Product::find($request->id);
            $product->featured = $request->status;
            $product->save();
            return response()->json(['success' => 'Product Featured status change Show']);
    }
}
