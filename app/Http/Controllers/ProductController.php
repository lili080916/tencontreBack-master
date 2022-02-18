<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        $category = array();

        foreach ($categories as $key => $cat) {
            array_push($category, array($cat->id => $cat->category));
        }
        return view('products.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'product' => ['required'],
            'category_id' => ['required'],
        ]);
  
          $data = $request->all();

          $product = Product::create($data);
  
          return redirect()->route('admin.products.index')->with('msg' ,'Successfull');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        $category = array();

        foreach ($categories as $key => $cat) {
            array_push($category, array($cat->id => $cat->category));
        }

        return view('products.edit', compact('product', 'category'));
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
        $this->validate(request(), [
            'product' => ['required'],
            'category_id' => ['required'],
          ]);
  
          $data = $request->all();
  
          $product = Product::findOrFail($id);
  
          $product->update($data);
  
          return redirect()->route('admin.products.index')->with('msg', 'Successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if (Auth::id() == $id) {
        //     return back()->with('err', "error");
        // }

        $product = Product::findOrFail($id);

        $product->delete();

        return back()->with('msg', 'Successfull');
    }

    /*******************************
    *   APi                        *
    ********************************/

    //  Product list
    public function allProduct($secretUpdate)
    {
        if ($secretUpdate != env('API_UPDATE', 'As31swudKV')) return response(['data' => 'Need Update'], 401);

        $data = array();
        $list = array();
        $categories = Category::all();

        foreach ($categories as $key => $category) {

            $products = Product::where('category_id', $category->id)->get();

            $catID = $category->id;
            $catName = $category->category;
            
            array_push($data, array('id' => $catID, 'product' => $catName, 'products' => $products));
        }

        return response(['data' => $data], 200);
    }
}
