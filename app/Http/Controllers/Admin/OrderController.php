<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with(['user', 'products'])->latest()->get();
        // return $orders;
        return view('admin.pages.orders.index', compact('orders'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->back()->with(['success' => 'Successfully deleted']);
    }

    /**
     * Undocumented function
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory::json
     */
    public function changeOrderStatus(Request $request)
    {
        $order = Order::find($request->id);
        $order->status = $request->status;
        $order->save();

        return response()->json($order);
    }
}
