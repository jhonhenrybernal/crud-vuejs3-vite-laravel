<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ClientController extends Controller
{
     /**
    * @author Jhon bernal
    * Valida la solicitud, verifica si el cliente existe y si la contraseña es correcta, y luego
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
        $User = Client::where('login', request()->login)->first();
        
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
     * Elimina todos los tokens asociados al cliente
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
     * Mostrar una lista del clientes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $User = Client::with('role')->get();
        return response()->json([
        "success" => true,
        "message" => "User List",
        "data" => $User
        ]);
    }

    /**
     * @author Jhon bernal
     * Muestra el formulario para crear un nuevo clientes.
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
        'login' => 'required|unique:clients'
        ],[
            'login.required' => 'El  :attribute es requerido.',
            'password.required' => 'El  :attribute es requerido.',
            'rol.required' => 'El  :attribute es requerido.',
            'login.required' => 'El  :attribute es requerido.',
            'login.unique' => 'El  :attribute ya existe.'
        ]);
        if($validator->fails()){
            return response()->json([
                "success" => false,
                "message" => "User creado.",
                "data" => $validator->errors()
                ]);     
        }
        $user = Client::create([
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
        "data" => Client::with('role')->get()
        ]);
    }

    /**
     *  @author Jhon bernal
     * Muestra el cliente especificado.
     *
     * @param  \App\Models\User  $customers
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Client::find($id);
        if (is_null($user)) {
            return $this->sendError('cliente no encontrado.');
        }
        return response()->json([
        "success" => true,
        "message" => "cliente especifico.",
        "data" => $user
        ]);

    }

    /**
     *  @author Jhon bernal
     * Actualice el uusario especificado en el almacenamiento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $customers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $input = $request->all();
        $client =  Client::find($id);
        $validator = Validator::make($input, [
            'name' => 'required',
            'rol' => 'required',
            'login' => 'required'
            ],[
                'login.required' => 'El  :attribute es requerido.',
                'rol.required' => 'El  :attribute es requerido.',
                'login.required' => 'El  :attribute es requerido.'
            ]);
        if($validator->fails()){
            return response()->json([
                "success" => false,
                "message" => "User List",
                "data" => $validator->errors()
                ]);   
        }
        $client->name = $input['name'];
        $client->rol = $input['rol'];
        $client->login = $input['login'];
        if ($input['password'] !== null) {
            $client->password = Hash::make($input['password']);
        }
        $client->save();
        return response()->json([
        "success" => true,
        "message" => "cliente actualizado.",
        "data" =>  Client::with('role')->get()
        ]);
    }

    /**
     *  @author Jhon bernal
     * Elimina el cliente especificado del almacenamiento.
     *
     * @param  \App\Models\Client  $customers
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Client::find($id)->delete();
        return response()->json([
            "success" => true,
            "message" => "cliente eliminado.",
            "data" => ''
        ]);
    }
}
