<?php

namespace App\Http\Controllers\Api\v1;

use Throwable;
use App\Traits\File;
use App\Models\Product;
use App\Traits\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ProductController extends Controller
{
    use Response, File;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $products = Product::latest()->get();

        return $this->successWithData($products, 'products');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\ProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductRequest $request, Product $product): JsonResponse
    {
        try {

            if ($file = $request->file('image')) {
                $path = 'products/images/';
                $url = $this->file($file, $path, 300, 400);
            }

            if ($request->expectsJson()) {

                $product->name = $request->name;
                $product->description = $request->description;
                $product->price = $request->price;
                $product->qty = $request->qty;
                $product->image = $url ?? null;

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
            if (method_exists(Repository::class, 'show')) {
                return $this->repository->show(Product::class, $product);
            }
        } catch (Throwable $th) {
            Log::info($th);
            return $this->error('Sorry! something went wrong!!', null, ResponseAlias::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\ProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductRequest $request, Product $product): JsonResponse
    {

        try {

            if ($file = $request->hasFile('image')) {
                $path = 'products/images/';
                $url = $this->file($file, $path, 300, 400);
            } else {
                $url = '';
            }

            if ($request->expectsJson()) {
                $product->name = $request->name;
                $product->description = $request->description;
                $product->price = $request->price;
                $product->qty = $request->qty;
                $product->image = $url ?: $product->image;

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
            if (method_exists(Repository::class, 'delete')) {
                if ($this->repository->delete(Product::class, $product)) {
                    return $this->success('Product deleted Successfully!', '', 'product', ResponseAlias::HTTP_OK);
                }
                return $this->error('Sorry! something went wrong!!', null, ResponseAlias::HTTP_UNAUTHORIZED);
            }
        } catch (Throwable $th) {
            Log::info($th);
            return $this->error('Sorry! something went wrong!!', null, ResponseAlias::HTTP_UNAUTHORIZED);
        }
    }
}
