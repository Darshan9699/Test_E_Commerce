<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminCategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryProducts = CategoryProduct::all();
        return view('admin.Category_Products.index')->with('categoryProducts', $categoryProducts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $products = Product::all();

        return view('admin.Category_Products.add')->with([
            'categories' => $categories,
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'category_id'=> 'required',
        ]);

        $categoryProduct = new CategoryProduct();
        $categoryProduct->product_id = $request->product_id;
        $categoryProduct->category_id = $request->category_id;
        $categoryProduct->save();

        return redirect()->route('admin.categoriesProducts')->with('success_message','your Category Products is create succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoryProduct =  CategoryProduct::find($id);
        return view('admin.Category_Products.view')->with('categoryProduct', $categoryProduct);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryProduct = CategoryProduct::where('id',$id)->first();
        $categories = Category::all();
        $products = Product::all();


        return view('admin.Category_Products.edit')->with([
            'categoryProduct' => $categoryProduct,
            'categories' => $categories,
            'products' => $products
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
            'product_id' => 'required',
            'category_id'=> 'required',
        ]);

        $categoryProduct =  CategoryProduct::find($id);
        $categoryProduct->product_id = $request->product_id;
        $categoryProduct->category_id = $request->category_id;
        $categoryProduct->save();

        return redirect()->route('admin.categoriesProducts')->with('success_message','your Category Products is Update succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoryProduct = CategoryProduct::find($id);
        $categoryProduct->delete();
        return redirect()->route('admin.categoriesProducts')->with('success_message','Your Category Products is Delete Successfully');
    }
}
