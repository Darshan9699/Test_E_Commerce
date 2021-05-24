<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginate = 9;
        $categories = Category::all();

        if (request()->category) {
            $products = Product::with('categories')->whereHas('categories', function ($query) {
                $query->where('slug', request()->category);
                $query->where('featured',true);
            });
            $categoryName = optional($categories->where('slug', request()->category)->first())->name;
        } else {
            // $products = Product::where('featured', true);
            $products = Product::where('featured', true);
            $categoryName = 'Featured';
        }

        if (request()->sort == 'low_high') {
            $products = $products->orderBy('product_pirce')->paginate(9);
        } elseif (request()->sort == 'high_low') {
            $products = $products->orderBy('product_pirce', 'desc')->paginate(9);
        } else {
            $products = $products->paginate($paginate);
        }

        // $products = Product::inRandomOrder()->take(4)->get();
        return view('shop')->with([
            'products' => $products,
            'categories' => $categories,
            'categoryName' => $categoryName
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product =  Product::where('slug',$slug)->firstOrFail();
        $related =  Product::where('slug','!=',$slug)->inRandomOrder()->take(4)->get();
        // dd($related);
        // dd($product);
        return view('product-details')->with([
            'product' => $product,
            'related' => $related  
        ]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|min:2',
        ]);

        $query = $request->input('query');

        $products = Product::where('product_name', 'like', "%$query%")->orWhere('details', 'like', "%$query%")->orWhere('product_description', 'like', "%$query%")->paginate(10);
        // $products = Product::search($query)->paginate(10);
        return view('search-results')->with('products', $products);
    }
}
