<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DatasetResource;
use App\Models\dataset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DatasetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new DatasetResource(dataset::all());
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
                'u' => ['required', 'numeric'],
                'bb' => ['required', 'numeric'],
                'tb' => ['required', 'numeric'],
                'lkkepala' => ['required', 'numeric'],
                'jarak' => ['numeric'],
                'gizi' => ['required', 'numeric'],
                'tinggi' => ['required', 'numeric'],
                'berat' => ['required', 'numeric'],
                'stunting' => ['required', 'numeric']
            ]);


            //response error validation
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
        } else {
            for ($d = 0; $d < count($data); $d++) {
                //save to database
                $dataset = dataset::create([
                    'u' => $data[$d]["u"],
                    'bb' => $data[$d]["bb"],
                    'tb' => $data[$d]["tb"],
                    'lkkepala' => $data[$d]["lkkepala"],
                    'jarak' => $data[$d]["jarak"],
                    'gizi' => $data[$d]["gizi"],
                    'tinggi' => $data[$d]["tinggi"],
                    'berat' => $data[$d]["berat"],
                    'stunting' => $data[$d]["stunting"]
                ]);
                $p = [
                    'name' => 'Insert Dataset',
                    'u' => $data[$d]["u"],
                    'bb' => $data[$d]["bb"],
                    'tb' => $data[$d]["tb"],
                    'lkkepala' => $data[$d]["lkkepala"],
                    'jarak' => $data[$d]["jarak"],
                    'gizi' => $data[$d]["gizi"],
                    'tinggi' => $data[$d]["tinggi"],
                    'berat' => $data[$d]["berat"],
                    'stunting' => $data[$d]["stunting"],
                    'status' => 'success', 'code' => 200
                ];
                array_push($result, $p);
            }
        }

        return new DatasetResource($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($dataset)
    {
        return new DatasetResource($dataset);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DatasetResource $dataset)
    {
        $result = [];
        $data = ($request->json("data"));

        if (count($data) == 0) {
            //set validation
            $validator = Validator::make($request->all(), [
                'u' => ['required', 'numeric'],
                'bb' => ['required', 'numeric'],
                'tb' => ['required', 'numeric'],
                'lkkepala' => ['required', 'numeric'],
                'jarak' => ['numeric'],
                'gizi' => ['required', 'numeric'],
                'tinggi' => ['required', 'numeric'],
                'berat' => ['required', 'numeric'],
                'stunting' => ['required', 'numeric']
            ]);

            //response error validation
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
        }

        //update to database
        $dataset->update([
            'balita'     => $data[0]["balita"]
        ]);

        $p = [
            'name' => 'Update balita',
            'u' => $data[0]["u"],
            'bb' => $data[0]["bb"],
            'tb' => $data[0]["tb"],
            'lkkepala' => $data[0]["lkkepala"],
            'jarak' => $data[0]["jarak"],
            'gizi' => $data[0]["gizi"],
            'tinggi' => $data[0]["tinggi"],
            'berat' => $data[0]["berat"],
            'stunting' => $data[0]["stunting"],
            'status' => 'success', 'code' => 200
        ];
        array_push($result, $p);

        return new DatasetResource($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($dataset)
    {
        $dataset->delete();

        return new DatasetResource($dataset);
    }
}
