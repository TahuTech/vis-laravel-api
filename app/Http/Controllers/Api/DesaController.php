<?php

namespace App\Http\Controllers\Api;

use App\Models\vis_desa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DesaResource;
use Illuminate\Support\Facades\Validator;
use DB;

class DesaController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new DesaResource(vis_desa::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'id_provinsi' => 'required',
            'id_kota'   => 'required',
            'id_kabupaten' => 'required',
            'id_kecamatan'   => 'required',
            'nama_desa' => 'required',
            'alamat_lengkap'   => 'required',
            'deskripsi' => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $kabupaten = vis_desa::create([
            'id_provinsi'     => $request->id_provinsi,
            'id_kota'     => $request->id_kota,
            'id_kabupaten'     => $request->id_kabupaten,
            'id_kecamatan'     => $request->id_kecamatan,
            'nama_desa'     => $request->nama_desa,
            'alamat_lengkap'     => $request->alamat_lengkap,
            'deskripsi'     => $request->deskripsi
        ]);

        return new DesaResource($kabupaten);
    }

    /**
     * Display the specified resource.
     *
     * @param  vis_desa $kabupaten
     * @return \Illuminate\Http\Response
     */
    public function show(vis_desa $kabupaten)
    {
        return new DesaResource($kabupaten);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  vis_desa $kabupaten
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, vis_desa $kabupaten)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'id_provinsi' => 'required',
            'id_kota'   => 'required',
            'id_kabupaten' => 'required',
            'id_kecamatan'   => 'required',
            'nama_desa' => 'required',
            'alamat_lengkap'   => 'required',
            'deskripsi' => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //update to database
        $kabupaten->update([
            'id_provinsi'     => $request->id_provinsi,
            'id_kota'     => $request->id_kota,
            'id_kabupaten'     => $request->id_kabupaten,
            'id_kecamatan'     => $request->id_kecamatan,
            'nama_desa'     => $request->nama_desa,
            'alamat_lengkap'     => $request->alamat_lengkap,
            'deskripsi'     => $request->deskripsi
        ]);

        return new DesaResource($kabupaten);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  vis_desa $kabupaten
     * @return \Illuminate\Http\Response
     */
    public function destroy(vis_desa $kabupaten)
    {
        $kabupaten->delete();
        
        return new DesaResource($kabupaten);
    }
}
