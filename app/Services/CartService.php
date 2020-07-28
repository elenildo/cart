<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\{Order, Product};


class CartService
{
    protected $orders;

    public function findProduct(int $id)
    {
        return Product::find($id);
    }

    public function findOrder(int $id)
    {
        return Order::find($id);
    }

    public function allOrders()
    {
        return Order::where(['status' => 'OP', 'user_id' => Auth::id()])->paginate(5);
    }

    public function saveOrder(int $id, Product $product)
    {
        $orders = Order::where(['status' => 'OP', 'user_id' => Auth::id()])->get();
        $order = new Order;

        if (count($orders)) {
            $order = $orders->last();
        } else {
            $order = Order::create([
                'user_id' => Auth::id(),
                'status' => 'OP'
            ]);
        }

        $productInCart = $order->order_products()->where('product_id', $id)->first();

        if (is_null($productInCart)) {
            $order->order_products()->create([
                'product_id' => $product->id,
                'value' => $product->price,
                'status' => 'OP'
            ]);
        } else {
            $order->order_products()->where('product_id', $id)->update([
                'qtd' => $productInCart->qtd + 1
            ]);
        }
    }

    public function deleteOrder(int $id)
    {
        $orders = Order::where(['status' => 'OP', 'user_id' => Auth::id()])->get();
        $order = new Order;

        if (count($orders)) {
            $order = $orders->last();
        }

        $item = $order->order_products()->where('product_id', $id)->first();

        if ($item->qtd > 1) {
            $item->qtd -= 1;
            $item->save();
        } else {
            $item->delete();
            if (!count($order->order_products) && $order->status == 'OP') {
                $order->delete();
            }
        }
    }

    public function finishCart(int $id)
    {
        return Order::find($id)->update([
            'status' => 'RE'
        ]);
    }
}