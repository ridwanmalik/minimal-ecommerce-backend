<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

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
        return view('admin.pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request, Product $product)
    {
        $product->name = $request->name;
        $product->price = $request->price;
        $product->qty = $request->qty;
        $product->description = $request->description;
        if ($request->hasFile('image')) {
            $product->image = url('/') . Storage::url($request->image->store('public/product/image'));
        }
        $product->save();

        return redirect()->route('products.index')->with(['success' => 'Successfully created a product']);
    }

    /**
     * Display the specified resource.
     *
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.pages.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->name = $request->name;
        $product->price = $request->price;
        $product->qty = $request->qty;
        $product->description = $request->description;
        if ($request->hasFile('image')) {
            $product->image = url('/') . Storage::url($request->image->store('public/product/image'));
        }
        $product->save();

        return redirect()->route('products.index')->with(['success' => 'Successfully updated a product']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
