<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::with('building')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '
                    <div class="d-flex d-flex flex-row align-items-center justify-content-start">
                        <a href=' . route("customer.edit", ["customer" => $row->id]) . ' class="btn btn-success btn-sm mx-1"><i class="fa fas fa-edit"></i></a>
                        <a href=' . route("customer.show", ["customer" => $row->id]) . ' class="btn btn-success btn-sm mx-1"><i class="fa fas fa-list"></i></a>
                        <a href="#" onclick="doDelete(this)" class="btn btn-danger btn-sm mx-1" data-id=' . $row->id . '><i class="fa fas fa-trash"></i></a>
                    </div>
                    ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('customer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            'gender' => 'required|in:male,female',
            'indentity_number' => 'required|string|min:16|max:16',
            'birth_place' => 'required|string',
            'birth_date' => 'required|date',
        ])->validate();
        DB::beginTransaction();
        try {
            Customer::create($request->all());
            DB::commit();

            return redirect()->route('customer.index')->with('success', 'Berhasil menambah data Pelanggan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {

        return view('customer.show', [
            'customer' => $customer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customer.edit', [
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        Validator::make($request->all(), [
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            'gender' => 'required|in:male,female',
            'indentity_number' => 'required|string|min:16|max:16',
            'birth_place' => 'required|string',
            'birth_date' => 'required|date',
        ])->validate();
        DB::beginTransaction();
        try {
            $customer->update($request->all());
            DB::commit();

            return redirect()->route('customer.index')->with('success', 'Berhasil merubah data Pelanggan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customer.index')->with('success', 'Berhasil menghapus data Pelanggan.');
    }
}
