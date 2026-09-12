<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource (Leer).
     */
    public function index()
    {
        if (request()->wantsJson()) {
            return Tarea::all();
        }

        $tareas = Tarea::with('usuarios')->orderBy('id', 'desc')->get();
        return view("tarea.index", compact('tareas'));
    }

    /**
     * Show the form for creating a new resource (Crear).
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
            if ($request->wantsJson()) {
                return response()->json([
                    "message" => "Los datos enviados no son válidos",
                    "errors" => $validator->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $usuario = auth()->user() ?? User::firstOrCreate(
            ["email" => "fabricio@idt.com.py"],
            [
                "name" => "Fabricio",
                "password" => "123456"
            ]
        );

        $request->merge([
            "user_id" => $usuario->id
        ]);

        $tarea = Tarea::create($request->all());

        if ($request->wantsJson()) {
            return $tarea;
        }

        return redirect('/tareas')->with('success', 'Tarea creada exitosamente');
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
        return Tarea::where("user_id", $userId)->get();
    }

    /**
     * Show the form for editing the specified resource (Actualizar).
     */
    public function edit(Tarea $tarea)
    {
        return view("tarea.edit", compact('tarea'));
    }

    /**
     * Update the specified resource in storage (Actualizar).
     */
    public function update(Request $request, Tarea $tarea)
    {
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
            if ($request->wantsJson()) {
                return response()->json([
                    "message" => "Los datos enviados no son válidos",
                    "errors" => $validator->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tarea->update($request->only(["descripcion", "prioridad", "realizado"]));

        if ($request->wantsJson()) {
            return response()->json($tarea);
        }

        return redirect('/tareas')->with('success', 'Tarea actualizada exitosamente');
    }

    /**
     * Toggle the status of a task.
     */
    public function toggle(Tarea $tarea)
    {
        $tarea->update([
            'realizado' => !$tarea->realizado
        ]);

        return redirect()->back()->with('success', 'Estado de la tarea actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage (No implementado según requerimiento).
     */
    public function destroy(Tarea $tarea)
    {
        // No implementado según requerimientos: solo actualizar, leer y crear
    }
}
