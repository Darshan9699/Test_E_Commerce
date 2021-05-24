<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('admin')){
            $categories = Category::all();
            return view('admin.Categories.index')->with('categories',$categories);
        } else {
            return redirect()->route('admin.login')->with('status','Logout Sucessfuy');//back to login pages and control
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::guard('admin')){
            return view('admin.Categories.add');
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

        if(Auth::guard('admin')){
            $request->validate([
                'name' => 'required|unique:categories,name',
                'slug'=> 'required|unique:categories,slug',
            ]);
    
            $categories = new Category();
            $categories->name = $request->name;
            $categories->slug = $request->slug;
            $categories->save();
    
            return redirect()->route('admin.categories')->with('success_message','your Category is create succesfully');
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
            $categories = Category::where('id',$id)->first();
            return view('admin.Categories.view')->with('categories', $categories);
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
            $categories = Category::find($id);
            return view('admin.Categories.edit')->with('categories', $categories);
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
                'name' => 'required|unique:categories,name',
                'slug'=> 'required|unique:categories,slug',
            ]);
    
            $categories = Category::find($id);
            $categories->name = $request->name;
            $categories->slug = $request->slug;
            $categories->save();
    
            return redirect()->route('admin.categories')->with('success_message','your Category is Update succesfully');
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
        $categories = Category::find($id);
        $categories->delete();
        return redirect()->route('admin.categories')->with('success_message','Your Category is Delete Successfully');
    }
}
