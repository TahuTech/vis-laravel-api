<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KnnResource;
use App\Models\knn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KnnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new KnnResource(knn::all());
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
                'id_balita' => ['required', 'numeric'],
                'u' => ['required', 'numeric'],
                'bb' => ['required', 'numeric'],
                'tb' => ['required', 'numeric'],
                'lkkepala' => ['required', 'numeric'],
                'bulan' => ['required', 'numeric'],
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
                $knn = knn::create([
                    'id_balita' => $data[$d]["id_balita"],
                    'u' => $data[$d]["u"],
                    'bb' => $data[$d]["bb"],
                    'tb' => $data[$d]["tb"],
                    'lkkepala' => $data[$d]["lkkepala"],
                    'bulan' => $data[$d]["bulan"],
                    'gizi' => $data[$d]["gizi"],
                    'tinggi' => $data[$d]["tinggi"],
                    'berat' => $data[$d]["berat"],
                    'stunting' => $data[$d]["stunting"],
                ]);
                $p = [
                    'name' => 'Insert KNN',
                    'id_balita' => $data[$d]["id_balita"],
                    'u' => $data[$d]["u"],
                    'bb' => $data[$d]["bb"],
                    'tb' => $data[$d]["tb"],
                    'lkkepala' => $data[$d]["lkkepala"],
                    'bulan' => $data[$d]["bulan"],
                    'gizi' => $data[$d]["gizi"],
                    'tinggi' => $data[$d]["tinggi"],
                    'berat' => $data[$d]["berat"],
                    'stunting' => $data[$d]["stunting"],
                    'status' => 'success', 'code' => 200
                ];
                array_push($result, $p);
            }
        }

        return new KnnResource($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($knn)
    {
        return new KnnResource($knn);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KnnResource $knn)
    {
        $result = [];
        $data = ($request->json("data"));

        if (count($data) == 0) {
            //set validation
            $validator = Validator::make($request->all(), [
                'id_balita' => ['required', 'numeric'],
                'u' => ['required', 'numeric'],
                'bb' => ['required', 'numeric'],
                'tb' => ['required', 'numeric'],
                'lkkepala' => ['required', 'numeric'],
                'bulan' => ['required', 'numeric'],
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
        $knn->update([
            'balita'     => $data[0]["balita"]
        ]);

        $p = [
            'name' => 'Update KNN',
            'id_balita' => $data[0]["id_balita"],
            'u' => $data[0]["u"],
            'bb' => $data[0]["bb"],
            'tb' => $data[0]["tb"],
            'lkkepala' => $data[0]["lkkepala"],
            'bulan' => $data[0]["bulan"],
            'gizi' => $data[0]["gizi"],
            'tinggi' => $data[0]["tinggi"],
            'berat' => $data[0]["berat"],
            'stunting' => $data[0]["stunting"],
            'status' => 'success', 'code' => 200
        ];
        array_push($result, $p);

        return new KnnResource($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(KnnResource $knn)
    {
        $knn->delete();

        return new KnnResource($knn);
    }
}
