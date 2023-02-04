<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\PurchaseOrderProductController;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->rol == 3) {    
            $purchaseOrder  = PurchaseOrder::where('user_id',auth()->user()->id)->with('purchaseOrderProduct')->with('client')->get();
        }else{
            $purchaseOrder  = PurchaseOrder::with('purchaseOrderProduct')->with('client')->get();
        }
        return response()->json([
        "success" => true,
        "message" => "User List",
        "data" => $purchaseOrder
        ]);
    }

    /**
     * @author Jhon bernal
     * Muestra el formulario para crear un nueva orden de compra.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
        'date_purchase' => 'required',
        ],[
            'date_purchase.required' => 'El  :attribute es requerido.',
        ]);
        if($validator->fails()){
            return response()->json([
                "success" => false,
                "message" =>  $validator->errors(),
                "data" => ''
                ]);    
        }

        if ($input['purchase_order_product'] == []) {
            return response()->json([
                "success" => false,
                "message" =>  "Se requiere escoger un producto",
                "data" => ''
                ]); 
        }
        $order = Str::random(10);
        $roleId = 0;

        if (auth()->user()->rol == 1) {
            $roleId = 1;
        }else{
            $roleId = Client::find(auth()->user()->id)->id;
        }
        $purchaseOrder = PurchaseOrder::create([
            'date_purchase' => $input['date_purchase'],
            'order' =>$order ,
            'user_id' => $roleId ,
            'cost' => 0
        ]);


        $purchaseOrderProduct = new PurchaseOrderProductController;
        $purchaseOrderProductStore = $purchaseOrderProduct->store($input['purchase_order_product'],$purchaseOrder->id);
        if (!$purchaseOrderProductStore) {
            return response()->json([
                "success" => false,
                "message" =>  "Error crear orden de compra productos",
                "data" => ''
                ]); 
        }
        $purchaseOrder->cost = $purchaseOrderProductStore;
        $purchaseOrder->save();

        if (auth()->user()->rol == 3) {    
            $purchaseOrder  = PurchaseOrder::where('user_id',auth()->user()->id)->with('purchaseOrderProduct')->with('client')->get();
        }else{
            $purchaseOrder  = PurchaseOrder::with('purchaseOrderProduct')->with('client')->get();
        }
        return response()->json([
        "success" => true,
        "message" => "Orden de compra creado.",
        "data" =>  $purchaseOrder
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\purchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            "success" => true,
            "message" => "Orden de compra creado.",
            "data" => PurchaseOrder::with('purchaseOrderProduct')->find($id)
        ]);
    }
}
