<?php

namespace App\Http\Controllers;

use App\Product;

use App\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();

        return inertia()->render('Dashboard/products/index',[
            'products' => $products
        ]);

    }


    public function create()
    {
        $categories = Category::all();
        return inertia()->render('Dashboard/products/create', [
            'categories' => $categories
        ]);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required',
            // 'image' => 'required',
            'category_id' => 'required',
        ]);

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            // 'image' => $request->image,
            'category_id' => $request->category_id
        ]);

        session()->flash('toast', [
            'type' => 'success',
            'message' => 'product created successfully'
        ]);

        return redirect()->route('products.index');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return inertia()->render('Dashboard/meals/edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required',
            // 'image' => 'required',
            'category_id' => 'required',
        ]);

        $product->update($data);

        session()->flash('toast', [
            'type' => 'success',
            'message' => 'Meal updated successfully'
        ]);

        return redirect()->route('meals.index');

    }

    public function destroy(Product $product)
    {
        $product->delete();

        session()->flash('toast', [
            'type' => 'error',
            'message' => 'Meal deleted successfully'
        ]);

        return redirect()->back();
    }
}
