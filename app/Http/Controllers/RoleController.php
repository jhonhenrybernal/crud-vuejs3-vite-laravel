<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RoleController extends Controller
{
      /**
     * @author Jhon bernal
     * Mostrar una lista del role.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->rol == 1 || auth()->user()->rol == 2) {
            $role = Role::whereIn('id',[1,2])->get();
        }else{
            $role = Role::all();
        }
        return response()->json([
        "success" => true,
        "message" => "Role Lista",
        "data" => $role
        ]);
    }

      /**
     * @author Jhon bernal
     * Mostrar una lista del role.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexClient()
    {
        $role = Role::whereIn('id',[1,3])->get();
        
        return response()->json([
        "success" => true,
        "message" => "Role Lista",
        "data" => $role
        ]);
    }

    /**
     * @author Jhon bernal
     * Muestra el formulario para crear un nuevo role.
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
        $role = Role::create([
            'name' => $input['name'],
        ]);
        return response()->json([
        "success" => true,
        "message" => "Role creado.",
        "data" => $role
        ]);
    }

    /**
     *  @author Jhon bernal
     * Muestra el role especificado.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        if (is_null($role)) {
            return $this->sendError('producto no encontrado.');
        }
        return response()->json([
        "success" => true,
        "message" => "Role especifico.",
        "data" => $role
        ]);
    }

    /**
     *  @author Jhon bernal
     * Actualice el role  especificado en el almacenamiento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
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
        $role->name = $input['name'];
        $role->save();
        return response()->json([
        "success" => true,
        "message" => "Role actualizado.",
        "data" => $role
        ]);
    }

    /**
     *  @author Jhon bernal
     * Elimina el role especificado del almacenamiento.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json([
            "success" => true,
            "message" => "Role eliminado.",
            "data" => $role
        ]);
    }
}
