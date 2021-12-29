<?php

namespace App\Http\Controllers\Api\v1;

use Throwable;
use App\Models\Product;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ProductController extends Controller
{
    use Response;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $products = Product::all();

        return $this->successWithData($products, 'products');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\ProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreProductRequest $request, Product $product): JsonResponse
    {
        try {


            
            if ($request->expectsJson()) {
                
                $product->name = $request->name;
                $product->description = $request->description;
                $product->price = $request->price;
                $product->qty = $request->qty;
                if ($request->hasFile('image')) {
                    $product->image = Storage::url($request->image->store('public/product/image'));
                }
                
                if ($product->save()) {
                    return $this->success('Product Created Successfully!', $product, 'product', ResponseAlias::HTTP_OK);
                }
                return $this->error('The image has invalid image dimensions!', null, ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            }
            return $this->error('Requested data is not valid!!', null, ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Throwable $e) {
            Log::info($e);
            return $this->error('Something went wrong!', null, ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        try {
            if ($product) {
                return $this->successWithSingleData($product);
            }
        } catch (Throwable $th) {
            Log::info($th);
            return $this->error('Sorry! something went wrong!!', null, ResponseAlias::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {

        try {

            if ($request->expectsJson()) {
                if ($request->name) {
                    $product->name = $request->name;
                }
                if ($request->description) {
                    $product->description = $request->description;
                }
                if ($request->price) {
                    $product->price = $request->price;
                }
                if ($request->qty) {
                    $product->qty = $request->qty;
                }
                if ($request->hasFile('image')) {
                    $product->image = Storage::url($request->image->store('public/product/image'));
                }
                

                if ($product->save()) {
                    return $this->success('Product Updated Successfully!', $product, 'product', ResponseAlias::HTTP_OK);
                }

                return $this->error('Something went wrong!', null, ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
            }
            return $this->error('Requested data is not valid!!', null, ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Throwable $e) {
            Log::info($e);
            return $this->error('Something went wrong!', null, ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        try {
            if ($product) {
                if ($product->delete()) {
                    return $this->success('Product deleted Successfully!', $product, 'product', ResponseAlias::HTTP_OK);
                }
                return $this->error('Sorry! something went wrong!!', null, ResponseAlias::HTTP_UNAUTHORIZED);
            }
        } catch (Throwable $th) {
            Log::info($th);
            return $this->error('Sorry! something went wrong!!', null, ResponseAlias::HTTP_UNAUTHORIZED);
        }
    }
}
