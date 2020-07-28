<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->middleware('auth');
        $this->cartService = $cartService;
    }

    public function index()
    {
        $orders = $this->cartService->allOrders();
        
        return view('home.cart', compact('orders'));
    }

    public function store(Request $request, int $id)
    {
        $product = $this->cartService->findProduct($id);

        if (is_null($product)) {
            $request->session()->flash('fail-message', 'Produto não encontrado');
            return redirect()->route('homepage');
        }

        $this->cartService->saveOrder($id, $product);
        
        return redirect()->route('carrinho');

    }

    public function destroy(Request $request, int $id)
    {
        $product = $this->cartService->findProduct($id);

        if (is_null($product)) {
            $request->session()->flash('fail-message', 'Produto não encontrado');
            return redirect()->route('homepage');
        }

        $this->cartService->deleteOrder($id);
        
        return redirect()->route('carrinho');

    }

    public function finish(Request $request, int $id)
    {
        $order = $this->cartService->findOrder($id);

        if (is_null($order)) {
            $request->session()->flash('fail-message', 'Pedido não encontrado');
            return redirect()->route('homepage');
        }

        $this->cartService->finishCart($id);

        return redirect()->route('carrinho');

    }
}
