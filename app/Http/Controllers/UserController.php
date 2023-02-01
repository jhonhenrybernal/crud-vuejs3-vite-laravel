<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

   /**
    * @author Jhon bernal
    * Valida la solicitud, verifica si el usuario existe y si la contraseña es correcta, y luego
    * devuelve una ficha
    * 
    * @return A JSON response con un token.
    */
    public function login()
    {
 
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ],
        [
            'email.required' => 'El  :attribute es requerido.',
            'password.required' => 'El  :attribute es requerido.'
        ]
    );
    
        if ($validator->fails()) {    
            return response()->json($validator->messages());
        }
        $User = User::where('login', request()->email)->first();
        
        if (!Hash::check(request()->password, $User->password)) {
            return response()->json('Contraseña incorrecta');
        }
        
        return response()->json([
            'token' => $User->createToken(request()->email)->plainTextToken
        ]);
    }

  
    /**
     * @author Jhon bernal
     * Elimina todos los tokens asociados al usuario
     *
     * @return Una respuesta JSON con un mensaje de "Cerrar sesión"
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out'
        ]);
    }


    /**
     * @author Jhon bernal
     * Mostrar una lista del usuarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * @author Jhon bernal
     * Muestra el formulario para crear un nuevo usuarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     *  @author Jhon bernal
     * Almacene un usuario recién creado en el almacenamiento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     *  @author Jhon bernal
     * Muestra el usuario especificado.
     *
     * @param  \App\Models\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function show(Customers $customers)
    {
        //
    }

    /**
     *  @author Jhon bernal
     * Muestra el formulario para editar el usuario especificado.
     *
     * @param  \App\Models\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function edit(Customers $customers)
    {
        //
    }

    /**
     *  @author Jhon bernal
     * Actualice el uusario especificado en el almacenamiento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customers $customers)
    {
        //
    }

    /**
     *  @author Jhon bernal
     * Elimina el usuario especificado del almacenamiento.
     *
     * @param  \App\Models\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customers $customers)
    {
        //
    }
}
