<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::where(['active' => 'Y'])->paginate(15);
        $banners = Product::where(['active' => 'Y'])->where('banner', true)->get();
        
        return view('home.index', compact('products','banners'));
    }

    public function product($id = null)
    {
        if (!is_null($id)) {
            $product = Product::where(['active' => 'Y', 'id' => $id])->first();
            if (!is_null($product)) {
                return view('home.product', compact('product'));
            }
        }
        return redirect()->route('index');
    }


}
