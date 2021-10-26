<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index() {
        // Buy product
        $orders = Order::where('customer_id', auth()->user()->id)->orderByDesc('created_at')->get();
        return view('admin.pages.transaction.index', [
            'orders' => $orders
        ]);
    }

    public function detail_buy($order_id) {
        $order = Order::find($order_id);
        return view('admin.pages.transaction.buy-detail', [
            'order' => $order
        ]);
    }

    // Selling ID
    public function sell() {
        // sell product
        $orders = Order::where('user_id', auth()->user()->id)->orderByDesc('created_at')->get();
        return view('admin.pages.transaction.sell', [
            'orders' => $orders
        ]);
    }

    public function detail_Sell($order_id) {
        $order = Order::find($order_id);
        return view('admin.pages.transaction.sell-detail', [
            'order' => $order
        ]);
    }

    public function accepted_order($order_id) {
        Order::find($order_id)->increment('payment_status');
        return back()->withSuccess('Pembayaran diterima');
    }

    public function deny_order($order_id) {
        Order::find($order_id)->decrement('payment_status');
        return back()->withSuccess('Pesanan ditolak');
    }

    public function input_tracking_code(Request $request, $order_id) {
        $order = Order::find($order_id);
        $setShipping = $order->increment('shipping_status');
        $updateResi = $order->update(['shipping_description' => $request->resi]);
        return back()->withSuccess('Resi pengiriman dikonfirmasi');
    }
}
