<?php

namespace App\Http\Controllers;

use App\Services\ProductsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(ProductsService $productsService)
    {
        $products = $productsService->findAll();
        return response()->json($products, 200);
    }

    public function show(string $id, ProductsService $productsService)
    {
        $product = $productsService->findOne($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found!'], 404);
        }

        return response()->json($product, 200);
    }


    public function store(Request $request, ProductsService $productsService)
    {
        $rules = [
            'name' => 'required|min:3',
            'author' => 'required|min:3',
            'year' => 'required|min:4',
            'quantity' => 'required|integer',
            'ref_code' => 'required|unique:products,ref_code',
            'price' => 'required'
        ];

        $validation = validator($request->only([
            'name',
            'author',
            'year',
            'quantity',
            'ref_code',
            'price'
        ]), $rules);

        if ($validation->fails()) {
            return response()->json([
                'error' => $validation->errors()->first()
            ], 400);
        }

        $product = $productsService->createProduct(
            $request->name,
            $request->author,
            $request->year,
            $request->quantity,
            $request->ref_code,
            $request->price
        );

        return response()->json($product, 201);
    }

    public function update(string $id, Request $request, ProductsService $productsService)
    {
        $rules = [
            'name' => 'required|min:3',
            'author' => 'required|min:3',
            'year' => 'required|min:4',
            'quantity' => 'required|integer',
            'price' => 'required'
        ];

        $validation = validator($request->only([
            'name',
            'author',
            'year',
            'quantity',
            'price'
        ]), $rules);

        if ($validation->fails()) {
            return response()->json([
                'error' => $validation->errors()->first()
            ], 400);
        }

        $product = $productsService->updateProduct(
            $request->name,
            $request->author,
            $request->year,
            $request->quantity,
            $request->price,
            $id
        );

        return response()->json($product, 200);
    }

    public function delete(string $id, ProductsService $productsService)
    {
        $productsService->delete($id);
        return response()->json([], 204);
    }
}
