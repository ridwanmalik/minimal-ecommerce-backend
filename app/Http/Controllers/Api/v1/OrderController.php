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
        $orders = Order::with('products')->get();
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
                $order->user_id = $request->user_id;
                $order->unique_id = Str::random(10);
                $order->status = $request->status ? $request->status : 'pending';
                $products = Product::find($request->product);
                foreach ($products as $product) {
                    // $product_data = Product::find($product);
                    $order->products()->attach($product->id, ['price' => $product->price]);
                }
                $order->save();
                return $this->successWithData($order, 'order');
                // $order->qty =
                // $order->total_price = ($request->stock_amount * $this->repository->price($request->product_id));

                // if ($this->repository->checkStockExistsOrNot($request->product_id) && $order->save()) {
                //     //let assume admin is only one
                //     $user = User::getAdmin()->first();
                //     // $user->notify(new \App\Notifications\OrderCompleted($order));
                //     return $this->success('Order Created Successfully!', $order, 'order', ResponseAlias::HTTP_OK);
                // }

                return $this->error('Product is out of stock now!!', null, ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
