<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrderProduct;
use App\Models\PurchaseOrder;
use App\Models\Product;
use Illuminate\Http\Request;

class PurchaseOrderProductController extends Controller
{
    /**
     * @author Jhon bernal
     * Muestra el formulario para crear un nueva orden de compra por producto.
     *
     * @return \Illuminate\Http\Response
     */
    public function store($id_products, $purchaseOrderId)
    {
        try {
            $cost = 0;
            $purchaseOrderProductId = [];
            foreach ($id_products as $key => $value) {
                $product =  Product::find($value);
                $purchaseOrderProduct = new PurchaseOrderProduct;            
                $purchaseOrderProduct->purchase_orders_id = $purchaseOrderId;
                $purchaseOrderProduct->product_id = $product->id; 
                $purchaseOrderProduct->save();
                $cost += $product->cost;
                $purchaseOrderProductId[] = $purchaseOrderProduct->id;

            }
            return $cost;
        } catch (\Throwable $th) {
            return  false;
        }
    }

}
