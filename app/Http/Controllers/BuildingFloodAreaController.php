<?php

namespace App\Http\Controllers;

use App\Models\BuildingFloodArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BuildingFloodAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = BuildingFloodArea::get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '
                    <div class="d-flex d-flex flex-row align-items-center justify-content-start">
                        <a href=' . route("building-flood-area.edit", ["building_flood_area" => $row->id]) . ' class="btn btn-success btn-sm mx-1"><i class="fa fas fa-edit"></i></a>
                        <a href="#" onclick="doDelete(this)" class="btn btn-danger btn-sm mx-1" data-id=' . $row->id . '><i class="fa fas fa-trash"></i></a>
                    </div>
                    ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('building-flood-area.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('building-flood-area.create');
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
            'height' => 'required|string'
        ])->validate();
        DB::beginTransaction();
        try {
            BuildingFloodArea::create($request->all());
            DB::commit();

            return redirect()->route('building-flood-area.index')->with('success', 'Berhasil menambah data area banjir.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BuildingFloodArea  $buildingFloodArea
     * @return \Illuminate\Http\Response
     */
    public function show(BuildingFloodArea $buildingFloodArea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BuildingFloodArea  $buildingFloodArea
     * @return \Illuminate\Http\Response
     */
    public function edit(BuildingFloodArea $buildingFloodArea)
    {
        return view('building-flood-area.edit', [
            'buildingFloodArea' => $buildingFloodArea
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BuildingFloodArea  $buildingFloodArea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BuildingFloodArea $buildingFloodArea)
    {
        Validator::make($request->all(), [
            'name' => 'required|string',
            'height' => 'required|string'
        ])->validate();
        DB::beginTransaction();
        try {
            $buildingFloodArea->update($request->all());
            DB::commit();

            return redirect()->route('building-flood-area.index')->with('success', 'Berhasil merubah data area banjir.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BuildingFloodArea  $buildingFloodArea
     * @return \Illuminate\Http\Response
     */
    public function destroy(BuildingFloodArea $buildingFloodArea)
    {
        $buildingFloodArea->delete();
        return redirect()->route('building-flood-area.index')->with('success', 'Berhasil menghapus data area banjir.');
    }
}
