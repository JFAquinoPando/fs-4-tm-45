<?php

use App\Http\Controllers\TareaController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


/* Route::get("/crear-usuario", function(){
    $usuario = new User();
    $usuario->name = "Juan";
    $usuario->email = "juan@perez.com";
    $usuario->password = "123456";
    $usuario->save();
    return $usuario;
}); */
Route::get("/tareas", [TareaController::class, "index"]);
Route::get("/formulario-tarea", [TareaController::class, "create"]);
Route::get("/tareas/{userId}/user", [TareaController::class, "showForUser"]);
Route::post("/tareas", [TareaController::class, "store"])->name("guardar");