<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Product;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::paginate(10);

        return view('admin.products', compact('products'));
    }

    public function create()
    {
        return view('admin.product');
    }

    public function store(Request $request)
    {
        $path = $request->file('image')->store('images');

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $path,
            'active' => $request->active
        ]);

        if ($product) {
            return redirect()->route('admin.produtos');
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);

        return view('admin.product', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $path = $product->image;

        if ($product) {
            if ($request->image != null) {
                Storage::delete($product->image);
                $path = $request->file('image')->store('images');
            }
            
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $path,
                'active' => $request->active
            ]);

            return redirect()->route('admin.produtos');
        }
    }
}
