<?php

namespace App\Http\Controllers;

use App\Services\CustomersService;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(CustomersService $customersService)
    {
        $customers = $customersService->findAll();
        return response()->json($customers, 200);
    }

    public function show(int $id, CustomersService $customersService)
    {
        $customer = $customersService->findOne($id);
        if (!$customer) {
            return response()->json(['error' => 'Customer not found!'], 404);
        }

        return response()->json($customer, 200);
    }


    public function store(Request $request, CustomersService $customersService)
    {
        $rules = [
            'name' => 'required|min:3',
            'cpf' => 'required|min:11',
            'address.street' => 'required|min:3',
            'address.number' => 'required|min:2',
            'address.district' => 'required|min:3',
            'address.compelement' => 'optional',
            'address.city' => 'required|min:3',
            'address.state' => 'required|min:3',
            'phoneNumber' => 'required|min:6'
        ];

        $validation = validator($request->all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'error' => $validation->errors()->first()
            ], 400);
        }

        $customer = $customersService->createCustomer(
            $request->name,
            $request->cpf,
            $request->address,
            $request->phoneNumber
        );
        return response($customer);
    }

    public function update(Request $request, int $id, CustomersService $customersService)
    {
        $rules = [
            'name' => 'required|min:3',
            'cpf' => 'required|min:11',
        ];

        $validation = validator($request->all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'error' => $validation->errors()->first()
            ], 400);
        }

        $customer = $customersService->update(
            $request->name,
            $request->cpf,
            $id
        );

        if (!$customer) {
            return response()->json(['error' => 'Customer not found!'], 404);
        }

        return response()->json($customer, 200);
    }

    public function createOrder(Request $request, CustomersService $customersService)
    {
        $rules = [
            'customer_id' => 'required|numeric|exists:customers,id',
            'product_id' => 'required|uuid|exists:products,id',
            'quantity' => 'required|numeric'
        ];

        $validation = validator($request->all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'error' => $validation->errors()->first()
            ], 400);
        }

        $order = $customersService->createOrder(
            $request->customer_id,
            $request->product_id,
            $request->quantity
        );

        return response()->json($order, 201);
    }

    public function delete(int $id, CustomersService $customersService)
    {
        $customersService->delete($id);
        return response()->json([], 204);
    }

}
