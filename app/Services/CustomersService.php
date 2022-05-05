<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CustomersService
{
    public function findAll()
    {
        $customers = DB::table('customers')
            ->select('id', 'name', 'cpf')
            ->orderBy('id', 'asc')
            ->get();
        return $customers;
    }

    public function findOne(int $id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $customer['address'] = $customer->address;
            $customer['phone'] = $customer->phone;
            $customer['orders'] = $this->fillOrders($id);
        }
        return $customer;
    }

    public function createCustomer(string $name, string $cpf, array $addressData, string $phoneNumber)
    {
        DB::beginTransaction();
        $customer = Customer::create([
            'name' => $name,
            'cpf' => $cpf
        ]);
        $this->createAddress($customer, $addressData);
        $this->createPhone($customer, $phoneNumber);
        DB::commit();

        return $customer;
    }


    private function createAddress(Customer $customer, array $addressData)
    {
        $customer->address()->create([
            'street' => $addressData['street'],
            'number' => $addressData['number'],
            'district' => $addressData['district'],
            'complement' => $addressData['complement'],
            'city' => $addressData['city'],
            'state' => $addressData['state']
        ]);
    }

    private function createPhone(Customer $customer, string $phoneNumber)
    {
        $customer->phone()->create([
            'number' => $phoneNumber
        ]);
    }

    public function createOrder(int $customer_id, string $product_id, int $quantity)
    {
        $customer = Customer::find($customer_id);
        $product = Product::find($product_id);
        $total_price = floatval($product['price']) * $quantity;

        $order = Order::create([
            'quantity' => $quantity,
            'unit_price' => $product['price'],
            'total_price' => strval($total_price),
            'customer_id' => $customer_id,
            'product_id' => $product_id
        ]);

        return $order;
    }

    private function fillOrders(int $customer_id)
    {
        $orders = DB::table('orders')
        ->leftJoin('products', 'orders.product_id', '=', 'products.id')
        ->select(
            'orders.id',
            'products.name as product_name',
            'orders.quantity',
            'orders.unit_price',
            'orders.total_price',
            'orders.created_at'
        )
        ->where('orders.customer_id', '=', $customer_id)
        ->orderBy('orders.created_at', 'desc')
        ->get();
        return $orders;
    }

    public function update(string $name, string $cpf, int $id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $customer->name = $name;
            $customer->cpf = $cpf;
            $customer->save();
        }
        return $customer;
    }

    public function delete(int $id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $customer->delete();
        }
    }
}
