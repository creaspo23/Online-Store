<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Product;


class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();

        return response()->json(['data' => $products, 'status' => 200]);
    }

    public function show(Product $product)
    {
        return response()->json(['data' => $product, 'status' => 200]);
    }

}
