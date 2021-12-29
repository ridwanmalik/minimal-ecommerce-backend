<?php

namespace App\Http\Controllers\Api\v1;

use Throwable;
use App\Models\Order;
use App\Traits\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Product;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class OrderController extends Controller
{
    use Response;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with(['user', 'products'])->get();
        return $this->successWithData($orders, 'orders');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request, Order $order)
    {
        try {
            if ($request->expectsJson()) {
                $productCount = sizeof($request->product);
                $qtyCount = sizeof($request->qty);
                if ($productCount != $qtyCount) {
                    return $this->error('Number of Products do not match with number of Quantity!!', null, ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
                }
                $products = Product::find($request->product);
                $index = 0;
                $total = 0;
                foreach ($products as $product) {
                    if ($product->qty < $request->qty[$index]) {
                        return $this->error('Product #' . $product->id . ' is out of stock now!!', null, ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
                    }
                    $total += ($product->price * $request->qty[$index]);
                }
                $order->user_id = $request->user_id;
                $order->unique_id = Str::random(10);
                $order->status = $request->status ? $request->status : 'pending';
                $order->total = $total;
                $order->save();
                $index = 0;
                foreach ($products as $product) {
                    $order->products()->attach($product->id, ['price' => $product->price, 'qty' => $request->qty[$index]]);
                    $index++;
                }
                return $this->success('Order Created Successfully!', $order->load(['user', 'products']), 'order', ResponseAlias::HTTP_OK);
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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        try {
            return $this->successWithData($order->load(['user', 'products']), 'order');
        } catch (Throwable $th) {
            Log::info($th);
            return $this->error('Sorry! something went wrong!!', null, ResponseAlias::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        try {
            if ($request->status) {
                $order->status = $request->status;
            }
            if ($order->save()) {
                return $this->successWithData($order->load(['user', 'products']), 'order');
            }
            return $this->error('Something went wrong!', null, ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Throwable $th) {
            Log::info($th);
            return $this->error('Sorry! something went wrong!!', null, ResponseAlias::HTTP_UNAUTHORIZED);
        }
    }
}
