<?php

namespace App\Http\Controllers;
use App\Models\MapDetail;
use Illuminate\Http\Request;

class MapDetailController extends Controller
{
    //
    public function autocomplete(Request $request){
        $data = $this->exec_sugges($request['id']);
        return response()->json($data);
        // print_r($data);
        // var_dump($data);

    }

    public function test(){
        $data =
        [
            "nama" => "fadhilla"
        ];
        return response()->json($data);
    }

    private function exec_sugges($place)
    {
        $model = new MapDetail();
        $data = $model->makeExecCall($place);
        // ...
        return $data;
    }
}
