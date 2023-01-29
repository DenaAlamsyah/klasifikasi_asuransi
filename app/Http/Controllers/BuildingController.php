<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\BuildingFloodArea;
use App\Models\BuildingObject;
use App\Models\BuildingType;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Building::get();
            return Datatables::of($data)
                ->editColumn(
                    'customer_name',
                    function ($row) {
                        return $row->customer->name;
                    }
                )
                ->addIndexColumn()->addColumn('action', function ($row) {
                    $btn = '
                    <div class="d-flex d-flex flex-row align-items-center justify-content-start">
                        <a href=' . route("building.edit", ["building" => $row->id]) . ' class="btn btn-success btn-sm mx-1"><i class="fa fas fa-edit"></i></a>
                        <a href=' . route("building.show", ["building" => $row->id]) . ' class="btn btn-success btn-sm mx-1"><i class="fa fas fa-list"></i></a>
                        <a href="#" onclick="doDelete(this)" class="btn btn-danger btn-sm mx-1" data-id=' . $row->id . '><i class="fa fas fa-trash"></i></a>
                    </div>
                    ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('building.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = customer::all();
        $buildings_object = BuildingObject::all();
        $buildings_type = BuildingType::all();
        $buildings_flood_area = BuildingFloodArea::all();
        return view('building.create', compact('customers', 'buildings_object', 'buildings_type', 'buildings_flood_area'));
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
            'customer_id' => 'required|string',
            'building_object_id' => 'required|string',
            'building_type_id' => 'required|string',
            'building_flood_area_id' => 'required|string',
            'address' => 'required|string',
            'floors' => 'required|numeric|min:0',
            'roof_type' => 'required|string',
            'wall_type' => 'required|string',
            'floor_type' => 'required|string',
            'is_production_process' => 'required|in:yes,no',
            'is_wildfire_risk' => 'required|in:yes,no',
            'security' => 'required|in:yes,no',
            'is_cctv_installed' => 'required|in:yes,no',
            'earthquake_area' => 'required|string',
            'building_value' => 'required|numeric|min:0',
        ])->validate();
        DB::beginTransaction();
        try {
            Building::create($request->all());
            DB::commit();

            return redirect()->route('building.index')->with('success', 'Berhasil menambah data Bangunan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function show(Building $building)
    {
        $customer = customer::find($building->id);
        $buildings_object = BuildingObject::find($building->id);
        $buildings_type = BuildingType::find($building->id);
        $buildings_flood_area = BuildingFloodArea::find($building->id);
        // return view(
        //     'building.show',
        //     [
        //         'customers' => $customer,

        //         'building' => $buildings_object, 'buildings_type' => $buildings_type, 'buildings_flood_area' => $buildings_flood_area
        //     ]
        // );
        // dd($customer);
        return view('building.show', [
            'building' => $building,
            'customer' => $customer,
            'building_object' => $buildings_object,
            'building_type' => $buildings_type,
            'building_flood_area' => $buildings_flood_area
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function edit(Building $building)
    {
        return view('building.edit', [
            'building' => $building
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Building $building)
    {
        Validator::make($request->all(), [
            'customer_id' => 'required|string',
            'building_object_id' => 'required|string',
            'building_type_id' => 'required|string',
            'building_flood_area_id' => 'required|string',
            'address' => 'required|string',
            'floors' => 'required|numeric|min:0',
            'roof_type' => 'required|string',
            'wall_type' => 'required|string',
            'floor_type' => 'required|string',
            'is_production_process' => 'required|string',
            'is_wildfire_risk' => 'required|string',
            'security' => 'required|string',
            'is_cctv_installed' => 'required|string',
            'earthquake_area' => 'required|string',
            'building_value' => 'required|numeric|min:0',
        ])->validate();
        DB::beginTransaction();
        try {
            $building->update($request->all());
            DB::commit();

            return redirect()->route('building.index')->with('success', 'Berhasil merubah data area bangunan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function destroy(Building $building)
    {
        $building->delete();
        return redirect()->route('building.index')->with('success', 'Berhasil menghapus data bangunan.');
    }
}
