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
}
