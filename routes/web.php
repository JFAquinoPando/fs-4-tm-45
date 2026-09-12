<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Redirección inicial a la lista de tareas
Route::get('/', function () {
    return redirect('/tareas');
});

/*
|--------------------------------------------------------------------------
| Rutas de Autenticación / Inicio de Sesión
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('salir');

/*
|--------------------------------------------------------------------------
| Rutas de Tareas (TodoList) - Solo Crear, Leer y Actualizar
|--------------------------------------------------------------------------
*/
Route::get('/tareas', [TareaController::class, 'index'])->name('tareas.index');
Route::get('/formulario-tarea', [TareaController::class, 'create'])->name('tareas.create')->middleware('auth');
Route::post('/tareas', [TareaController::class, 'store'])->name('guardar')->middleware('auth');
Route::get('/tareas/{tarea}/editar', [TareaController::class, 'edit'])->name('tareas.edit');
Route::put('/tareas/{tarea}', [TareaController::class, 'update'])->name('tareas.update');
Route::patch('/tareas/{tarea}/toggle', [TareaController::class, 'toggle'])->name('tareas.toggle');
Route::get('/tareas/{userId}/user', [TareaController::class, 'showForUser']);

/*
|--------------------------------------------------------------------------
| Rutas de Usuarios - Solo Crear, Leer y Actualizar
|--------------------------------------------------------------------------
*/
Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
Route::get('/usuarios/crear', [UserController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/{usuario}/editar', [UserController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/{usuario}', [UserController::class, 'update'])->name('usuarios.update');