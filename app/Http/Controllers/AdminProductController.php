<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('admin')){
            $products = Product::all();//show products
            $category = Category::all();//show category
            return view('admin.Products.index')->with([
                'Products' => $products,
                'Category' => $category
            ]);
        } else {
            return redirect()->route('admin.login')->with('status','Logout Sucessfuy');//back to login pages and control
        }
    }

    public function filterProduct(Request $request)
    {
        $category = Category::find($request->id);
        $name = $category->name;
        $Products = Product::with('categories')->whereHas('categories', function ($query) use ($name) {
            $query->where('slug', $name );
        })->get();

       return response()->view('admin.Products.filter',compact('Products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::guard('admin')){
            $allCategories = Category::all();
            return view('admin.Products.add')->with('allCategories',$allCategories);
        } else {
            return redirect()->route('admin.login')->with('status','Logout Sucessfuy');//back to login pages and control
        }
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

        if(Auth::guard('admin')){
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

            $data = Product::latest('id')->first();
            $insertId = $data->id;

             //enter to category
            if($request->category) {
                foreach($request->category as $category){
                    $id = $insertId;
                    CategoryProduct::create([
                        'product_id' => $id,
                        'category_id'=> $category
                    ]);
                }
            }

            // $imageName = time().'.'.$request->image->extension();
            // $request->image->move(public_path('images'), $imageName);

            return redirect()->route('admin.products')->with('success_message','your Product is create succesfully');
        } else {
            return redirect()->route('admin.login')->with('status','Logout Sucessfuy');//back to login pages and control
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::guard('admin')){
            $product = Product::where('id',$id)->get();
            return view('admin.Products.productview')->with('product', $product);
        } else {
            return redirect()->route('admin.login')->with('status','Logout Sucessfuy');//back to login pages and control
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::guard('admin')){
            $product = Product::where('id',$id)->first();
            $allCategories = Category::all();

            $product = Product::find($id);
            $categoriesForProduct = $product->categories()->get();

            return view('admin.Products.edit')->with([
                'products' => $product,
                'allCategories' => $allCategories,
                'categoriesForProduct' => $categoriesForProduct
            ]);
        } else {
            return redirect()->route('admin.login')->with('status','Logout Sucessfuy');//back to login pages and control
        }

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
        if(Auth::guard('admin')){
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
        } else {
            return redirect()->route('admin.login')->with('status','Logout Sucessfuy');//back to login pages and control
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::guard('admin')){
            $product = Product::find($id);
            $product->delete();
            return redirect()->route('admin.products')->with('success_message','Your Product is Delete Successfully');
        } else {
            return redirect()->route('admin.login')->with('status','Logout Sucessfuy');//back to login pages and control
        }
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
