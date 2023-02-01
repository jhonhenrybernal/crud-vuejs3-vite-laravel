<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
      /**
     * @author Jhon bernal
     * Mostrar una lista del productos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return response()->json([
        "success" => true,
        "message" => "productos Lista",
        "data" => $product
        ]);
    }

    /**
     * @author Jhon bernal
     * Muestra el formulario para crear un nuevo productos.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
        'name' => 'required'
        ],[
            'name.required' => 'El  :attribute es requerido.'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $product = Product::create([
            'name' => $input['name'],
        ]);
        return response()->json([
        "success" => true,
        "message" => "productos creado.",
        "data" => $product
        ]);
    }

    /**
     *  @author Jhon bernal
     * Muestra el poroducto especificado.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return $this->sendError('producto no encontrado.');
        }
        return response()->json([
        "success" => true,
        "message" => "Producto especifico.",
        "data" => $product
        ]);

    }

    /**
     *  @author Jhon bernal
     * Actualice el producto especificado en el almacenamiento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
      
            ],[
                'name.required' => 'El  :attribute es requerido.'
            ]);
        if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
        }
        $product->name = $input['name'];
        $product->save();
        return response()->json([
        "success" => true,
        "message" => "Producto actualizado.",
        "data" => $product
        ]);
    }

    /**
     *  @author Jhon bernal
     * Elimina el producto especificado del almacenamiento.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            "success" => true,
            "message" => "Cliente eliminado.",
            "data" => $product
        ]);
    }
}
