<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BalitaResource;
use App\Models\balita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BalitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new BalitaResource(balita::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = [];
        $data = ($request->json("data"));
        //dd($data[0]["balita"]);
        //set validation
        if (count($data) == 0) {
            $validator = Validator::make($request->all(), [
                'balita'   => 'required'
            ]);


            //response error validation
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
        } else {
            for ($d = 0; $d < count($data); $d++) {
                //save to database
                $balita = balita::create([
                    'balita'     => $data[$d]["balita"]
                ]);
                $p = [
                    'name' => 'Insert balita',
                    'balita' => $data[$d]["balita"],
                    'status' => 'success', 'code' => 200
                ];
                array_push($result, $p);
            }
        }


        return new BalitaResource($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($balita)
    {
        return new BalitaResource($balita);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BalitaResource $balita)
    {
        $result = [];
        $data = ($request->json("data"));

        if (count($data) == 0) {
            //set validation
            $validator = Validator::make($request->all(), [
                'balita'   => 'required'
            ]);

            //response error validation
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
        }

        //update to database
        $balita->update([
            'balita'     => $data[0]["balita"]
        ]);

        $p = [
            'name' => 'Update balita',
            'balita' => $data[0]["balita"],
            'status' => 'success', 'code' => 200
        ];
        array_push($result, $p);

        return new BalitaResource($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BalitaResource $balita)
    {
        $balita->delete();

        return new BalitaResource($balita);
    }
}
