<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Tarea::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("tarea.formulario");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        /* $request = [
            "test" => "otro valor",
            "prioridad" => "EL dato"
        ];

        $requestNuevo = [
            "prioridad" => boolean("EL dato"),
            "apellido" => "Alvarez"
        ];

        $nuevo = [
             "test" => "otro valor",
            "prioridad" => boolean("EL dato"),
            "apellido" => "Alvarez"
        ]; */

        $request->merge([
            "prioridad" => $request->boolean("prioridad"),
            "realizado" => $request->boolean("realizado")
        ]);

        $validator = Validator::make($request->all(), [
            "descripcion" => "required|string",
            "prioridad" => "boolean",
            "realizado" => "boolean"
        ], [
            "descripcion.required" => "La descripción es obligatoria"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => "Los datos enviados no son válidos",
                "errors" => $validator->errors()
            ], 422);
        }


        $usuario = User::firstOrCreate(
            ["email" => "fabricio@idt.com.py"],
            [
                "name" => "Fabricio",
                "password" => "123456"
            ]
        );

        $request->merge([
            "user_id" => $usuario->id
        ]);

        return Tarea::create(
            $request->all()
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarea $tarea)
    {
        //
    }

    /* Mostrar todas las tareas de un usuario */

    public function showForUser(string $userId){
        return  Tarea::where("user_id", $userId)->get();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarea $tarea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarea $tarea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarea $tarea)
    {
        //
    }
}
