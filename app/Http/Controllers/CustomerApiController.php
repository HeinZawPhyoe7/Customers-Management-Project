<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();

        return response()->json([
            'customers' => $customers,
            'message'  => 'success',
            'code'     => 200
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $password = Hash::make($request->password);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = $password;
        $customer->phone = $request->phone;
        $customer->adress = $request->adress;
        $customer->role = $request->role;
        $customer->date_of_birth = $request->date_of_birth;
        $customer->save();

        return response()->json([
            'message' => 'Customer is successfully stored',
            'code'     => 200,
            'newcustomer' => $customer

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login(Request $request)
    {

        $customer = Customer::where('email', $request->email)->first();

        if ($customer) {
            if (Hash::check($request->password, $customer->password)) {
                return response()->json([
                    'message' => 'customer is successfully logged in.',
                    'login customer' => $customer,

                ]);
            } else {
                return response()->json([
                    'message' => 'customer password is incorrect.',
                    'code'  => 401
                ], 401);
            }
        } else {
            return response()->json([
                'message' => 'customer is not found.',
                'code'  => 404
            ], 404);
        }
    }
}
