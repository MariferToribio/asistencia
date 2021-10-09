<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //                    where('nombre','Samuel')->where('estatus','Activo')->get()    all() = get()
        //$personas = Persona::where('user_id', Auth::id())->get(); #Muestra solo los del usuario

                                #Se esta trayendo como atributo, no se le puede concatenar nada mas
        $personas = Auth::user()->personas; #personas()->toSql() - arroja la sentencia sql que esta creando
                                            #personas()->get()  - (se trae a personas como metodo)

        return view('personas/personasIndex', compact('personas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('personas/personasForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        /*  
            Asignar las propiedades del modelo (columnas)
            Guardar
            Redireccionar a index
        */

        #Validar datos
        $request->validate([
            'nombre' => 'required|max:255',
            'apellido_paterno' => 'required|max:255',
            'apellido_materno' => 'required|max:255',
            'identificador' => 'required|max:255|unique:App\Models\Persona,identificador',
            'correo' => 'email|max:255',
            'telefono' => 'max:50'
        ]);

        #Crear instancia de modelo
        /*$persona = new Persona();*/
        $request->merge([
            'user_id' => Auth::id(), #Informacion que no viene del formulario
            'apellido_materno' => $request->apellido_materno ?? ''
        ]); 
        #Agregar en fillable Persona.php
         
        Persona::create($request->all());

        #Crear registro utilizando modelo
        /*$persona->nombre = $request->nombre;
        $persona->apellido_paterno = $request->apellido_paterno;
        $persona->apellido_materno = $request->apellido_materno;
        $persona->identificador = $request->identificador;
        $persona->correo = $request->correo ?? '';
        $persona->telefono = $request->telefono ?? '';
        $persona->save();*/

        return redirect()->route('persona.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        return view('personas/personasShow', compact('persona')); #('personas.personaShow')
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
        return view('personas/personasForm',compact('persona'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persona $persona)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'apellido_paterno' => 'required|max:255',
            'apellido_materno' => 'required|max:255',
            /*'identificador' => [
                'required',
                Rule::unique('personas')->ignore($persona->id)
            ],*/
            'correo' => 'email|max:255',
            'telefono' => 'max:50'
        ]);

        Persona::where('id', $persona->id)
            ->update($request->except('_token','_method'));

        #Registro utilizando modelo
        /*
        $persona->nombre = $request->nombre;
        $persona->apellido_paterno = $request->apellido_paterno;
        $persona->apellido_materno = $request->apellido_materno;
        $persona->identificador = $request->identificador;
        $persona->correo = $request->correo ?? '';
        $persona->telefono = $request->telefono ?? '';
        $persona->save();
        */

        #Redireccionar a persona.show
        return redirect()->route('persona.show', $persona);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        $persona->delete();
        #instancia de la persona, accedo a un metodo que heredo del modelo
        return redirect()->route('persona.index');
    }
}
