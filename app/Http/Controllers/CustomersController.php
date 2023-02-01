<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
        /**
     * @author Jhon bernal
     * Mostrar una lista del clientes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * @author Jhon bernal
     * Muestra el formulario para crear un nuevo clientes.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     *  @author Jhon bernal
     * Almacene un clientes recién creado en el almacenamiento.
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
     * Muestra el clientes especificado.
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
     * Muestra el formulario para editar el clientes especificado.
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
     * Actualice el clientes especificado en el almacenamiento.
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
     * Elimina el clientes especificado del almacenamiento.
     *
     * @param  \App\Models\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customers $customers)
    {
        //
    }
}
