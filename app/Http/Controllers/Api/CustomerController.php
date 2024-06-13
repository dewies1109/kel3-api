<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\customer;
use App\Http\Resources\CustomerResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::latest()->paginate(5);
        return new CustomerResource(true, 'List Data Customers', $customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_customer' => 'required',
            'no_hp_customer' => 'required',
            'email_customer' => 'required',
            'password_customer' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $customer = Customer::create([
            'nama_customer' => $request->nama_customer,
            'no_hp_customer' => $request->no_hp_customer,
            'email_customer' => $request->email_customer,
            'password_customer' => $request->password_customer,
        ]);

        return new CustomerResource(true, 'Data Customer Berhasil Ditambahkan!', $customer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return new CustomerResource(true, 'Data Customer Ditemukan!', $customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $validator = Validator::make($request->all(), [
            'nama_customer' => 'required',
            'no_hp_customer' => 'required',
            'email_customer' => 'required',
            'password_customer' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('image')){

            $image = $request->file('image');
            $image -> storeAs('public/posts', $image->hashName());

            Storage::delete('public/posts/'.$post->image);

            $customer->update([
                'nama_customer' => $request->nama_customer,
                'no_hp_customer' => $request->no_hp_customer,
                'email_customer' => $request->email_customer,
                'password_customer'=> $request->password_customer,
            ]);
        } else {

            $customer->update([
                'nama_customer' => $request->nama_customer,
                'no_hp_customer' => $request->no_hp_customer,
                'email_customer' => $request->email_customer,
                'password_customer'=> $request->password_customer,
            ]);
        }
        return new CustomerResource(true, 'Data Customer Berhasil Diubah!', $customer);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return new CustomerResource(true, 'Data Customer Berhasil Dihapus!', null);
    }
}
