<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Costumer;
use Illuminate\Support\Facades\Validator;

class CostumerController extends Controller
{
    public function show(){
        return Costumer::all();
    }

    public function store(Request $request){
        $validator=Validator::make($request->all(),
            [
                'nama' => 'required',
                'alamat' => 'required'
            ]
        );

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan = Costumer::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat
        ]);

        if($simpan){
            return Response()->json(['status' =>1]);
        }else{
            return Response()->json(['status' =>0]);
        }
    }
}
