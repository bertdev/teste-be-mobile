<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsService
{
    public function createProduct(string $name, string $author, string $year, int $quantity, string $ref_code, string $price): Product
    {
        $product = Product::create([
            'id' => Str::uuid(),
            'name' => $name,
            'author' => $author,
            'year' => $year,
            'quantity' => $quantity,
            'ref_code' => $ref_code,
            'price' => $price
        ]);

        return $product;
    }

    public function updateProduct(string $name, string $author, string $year, int $quantity, string $price, string $id): Product
    {
        $product = Product::find($id);
        $product->name = $name;
        $product->author = $author;
        $product->year = $year;
        $product->quantity = $quantity;
        $product->price = $price;
        $product->save();

        return $product;
    }

    public function findAll()
    {
        $products = DB::table('products')
            ->select('id', 'name', 'ref_code', 'price')
            ->where('is_active', '=', 1)
            ->orderBy('name', 'asc')
            ->get();
        return $products;
    }

    public function findOne(string $id)
    {
        $product = Product::find($id);
        return $product;
    }

    public function delete(string $id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->is_active = 0;
            $product->save();
        }
    }
}
