<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Product;

class ProductsController extends Controller
{
    public function index()
    {
        return Product::all();
    }
 
    public function show(Product $product)
    {
        return $product;
    }
 
    public function store(Request $request)
    {
        $ipAddress =  $request->ip();
        $loginfo = $ipAddress;
	Log::info($loginfo);
	$this->validate($request, [
        'title' => 'required|unique:products|max:255',
        'description' => 'required',
        'price' => 'integer',
        'availability' => 'boolean',
    ]);

	var_dump(request);
        $product = Product::create($request->all());
 
        return response()->json($product, 201);
    }
 
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
 
        return response()->json($product, 200);
    }
 
    public function delete(Product $product)
    {
	Log::info('I want to delete some records');

        $product->delete();
 
	Log::info('II want to delete some records!');

        return response()->json(null, 204);
    }
 
}
