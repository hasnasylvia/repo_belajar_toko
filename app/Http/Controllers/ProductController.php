<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function show(){
        return Product::all();
    }

    public function store(Request $request){
        $validator=Validator::make($request->all(),
            [
                'barang' => 'required'
            ]
        );

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan = Product::create([
            'barang' => $request->barang
        ]);

        if($simpan){
            return Response()->json(['status' =>1]);
        }else{
            return Response()->json(['status' =>0]);
        }
    }
    public function destroy($id_product){
        $hapus = Product::where('id_product', $id_product)->delete();
        if($hapus){
            return Response()->json(['status' => 1]);
        }else{
            return Response()->json(['status' => 0]);
        }
    }
}
