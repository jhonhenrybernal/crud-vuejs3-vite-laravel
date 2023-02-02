<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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
            'login' => 'required',
            'password' => 'required',
        ],
        [
            'login.required' => 'El  :attribute es requerido.',
            'password.required' => 'El  :attribute es requerido.'
        ]
        );  
        if ($validator->fails()) { 
            return response()->json([
                "success" => false,
                "message" => "User List",
                "data" =>  $validator->messages()
                ]);   
        }
        $User = User::where('login', request()->login)->first();
        
        if (!Hash::check(request()->password, $User->password)) {
            return response()->json([
                "success" => false,
                "message" => "User List",
                "data" =>  'Contraseña incorrecta'
                ]);   
        }
        return response()->json([
            "success" => true,
            "message" => "User List",
            "data" =>  $User->createToken(request()->login)->plainTextToken
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
        $User = User::all();
        return response()->json([
        "success" => true,
        "message" => "User List",
        "data" => $User
        ]);
    }

    /**
     * @author Jhon bernal
     * Muestra el formulario para crear un nuevo usuarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
        'name' => 'required',
        'password' => 'required',
        'rol' => 'required',
        'login' => 'required'
        ],[
            'login.required' => 'El  :attribute es requerido.',
            'password.required' => 'El  :attribute es requerido.',
            'rol.required' => 'El  :attribute es requerido.',
            'login.required' => 'El  :attribute es requerido.'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $user = User::create([
            'name' => $input['name'],
            'login' => $input['login'],
            'password' => Hash::make($input['password']), // password
            'remember_token' => Str::random(10),
            'login_verified_at' => now(),
            'rol' => $input['rol']
        ]);
        return response()->json([
        "success" => true,
        "message" => "User creado.",
        "data" => $user
        ]);
    }

    /**
     *  @author Jhon bernal
     * Muestra el usuario especificado.
     *
     * @param  \App\Models\User  $customers
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return $this->sendError('usuario no encontrado.');
        }
        return response()->json([
        "success" => true,
        "message" => "Usuario especifico.",
        "data" => $user
        ]);

    }

    /**
     *  @author Jhon bernal
     * Actualice el uusario especificado en el almacenamiento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $customers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'password' => 'required',
            'rol' => 'required',
            'login' => 'required'
            ],[
                'login.required' => 'El  :attribute es requerido.',
                'password.required' => 'El  :attribute es requerido.',
                'rol.required' => 'El  :attribute es requerido.',
                'login.required' => 'El  :attribute es requerido.'
            ]);
        if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
        }
        $user->name = $input['name'];
        $user->rol = $input['rol'];
        $user->login = $input['login'];
        $user->password = $input['password'];
        $user->save();
        return response()->json([
        "success" => true,
        "message" => "Usuario actualizado.",
        "data" => $user
        ]);
    }

    /**
     *  @author Jhon bernal
     * Elimina el usuario especificado del almacenamiento.
     *
     * @param  \App\Models\User  $customers
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            "success" => true,
            "message" => "usuario eliminado.",
            "data" => $user
        ]);
    }
}
