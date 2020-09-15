<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function show(){
        $data_order = Order::join('costumer', 'order.id_costumer', 'costumer.id_costumer')
                           ->join('product', 'order.id_product', 'product.id_product')
                           ->get();
        return Response()->json($data_order);
    }

    public function detail($id){
        if(Order::where('id', $id)->exist()){
            $data_order = Order::join('costumer', 'order.id_costumer', 'costumer.id_costumer')
                               ->where('order.id', '=', $id)
                               ->get();
            return Response()->json($data_order);
        }else{
            return Response()->json(['message' => 'Tidak Ditemukan']);
        }
    }

    public function store(Request $request){
        $validator=Validator::make($request->all(),
            [
                'id_costumer' => 'required',
                'id_product' => 'required'
            ]
        );

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan = Order::create([
            'id_costumer' => $request->id_costumer,
            'id_product' => $request->id_product
        ]);

        if($simpan){
            return Response()->json(['status' =>1]);
        }else{
            return Response()->json(['status' =>0]);
        }
    }
    public function update($id, Request $request){
        $validator=Validator::make($request->all(),
            [
                'id_costumer' => 'required',
                'id_product' => 'reqiured'
            ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $ubah = Order::where('id', $id)->update([
            'id_costumer' => $request->id_costumer,
            'id_product' => $request->id_product
        ]);
        if($ubah){
            return Response()->json(['status' => 1]);
        }else{
            return Response()->json(['status' => 0]);
        }
    }
    public function destroy($id){
        $hapus = Order::where('id', $id)->delete();
        if($hapus){
            return Response()->json(['status' => 1]);
        }else{
            return Response()->json(['status' => 0]);
        }
    }
}
