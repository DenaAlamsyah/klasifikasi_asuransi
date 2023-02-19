<?php

namespace App\Http\Controllers;

use App\Models\BuildingType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BuildingTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = BuildingType::get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '
                    <div class="d-flex d-flex flex-row align-items-center justify-content-start">
                        <a href=' . route("building-type.edit", ["building_type" => $row->id]) . ' class="btn btn-success btn-sm mx-1"><i class="fa fas fa-edit"></i></a>
                        <a href="#" onclick="doDelete(this)" class="btn btn-danger btn-sm mx-1" data-id=' . $row->id . '><i class="fa fas fa-trash"></i></a>
                    </div>
                    ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('building-type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('building-type.create');
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
            'description' => 'required|string'
        ])->validate();
        DB::beginTransaction();
        try {
            BuildingType::create($request->all());
            DB::commit();

            return redirect()->route('building-type.index')->with('success', 'Berhasil menambah data tipe bangunan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BuildingType  $buildingType
     * @return \Illuminate\Http\Response
     */
    public function show(BuildingType $buildingType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BuildingType  $buildingType
     * @return \Illuminate\Http\Response
     */
    public function edit(BuildingType $buildingType)
    {
        return view('building-type.edit', [
            'buildingType' => $buildingType
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BuildingType  $buildingType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BuildingType $buildingType)
    {
        Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string'
        ])->validate();
        DB::beginTransaction();
        try {
            $buildingType->update($request->all());
            DB::commit();

            return redirect()->route('building-type.index')->with('success', 'Berhasil merubah data tipe bangunan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BuildingType  $buildingType
     * @return \Illuminate\Http\Response
     */
    public function destroy(BuildingType $buildingType)
    {
        $buildingType->delete();
        return redirect()->route('building-type.index')->with('success', 'Berhasil menghapus data tipe bangunan.');
    }
}
