<?php

namespace App\Http\Controllers;

use App\Models\BuildingObject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BuildingObjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = BuildingObject::get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '
                    <div class="d-flex d-flex flex-row align-items-center justify-content-start">
                        <a href=' . route("building-object.edit", ["building_object" => $row->id]) . ' class="btn btn-success btn-sm mx-1"><i class="fa fas fa-edit"></i></a>
                        <a href="#" onclick="doDelete(this)" class="btn btn-danger btn-sm mx-1" data-id=' . $row->id . '><i class="fa fas fa-trash"></i></a>
                    </div>
                    ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('building-object.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('building-object.create');
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
            BuildingObject::create($request->all());
            DB::commit();

            return redirect()->route('building-object.index')->with('success', 'Berhasil menambah data objek bangunan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BuildingObject  $buildingObject
     * @return \Illuminate\Http\Response
     */
    public function show(BuildingObject $buildingObject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BuildingObject  $buildingObject
     * @return \Illuminate\Http\Response
     */
    public function edit(BuildingObject $buildingObject)
    {
        return view('building-object.edit', [
            'buildingObject' => $buildingObject
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BuildingObject  $buildingObject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BuildingObject $buildingObject)
    {
        Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string'
        ])->validate();
        DB::beginTransaction();
        try {
            $buildingObject->update($request->all());
            DB::commit();

            return redirect()->route('building-object.index')->with('success', 'Berhasil merubah data objek bangunan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BuildingObject  $buildingObject
     * @return \Illuminate\Http\Response
     */
    public function destroy(BuildingObject $buildingObject)
    {
        $buildingObject->delete();
        return redirect()->route('building-object.index')->with('success', 'Berhasil menghapus data objek bangunan.');
    }
}
