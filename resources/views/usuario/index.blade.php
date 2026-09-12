@extends('layouts.app')

@section('title', 'Usuarios - TaskHub')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-slate-200">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Gestión de Usuarios</h1>
            <p class="text-sm text-slate-500 mt-1">Directorio de usuarios registrados en el sistema.</p>
        </div>
        <a href="{{ url('/usuarios/crear') }}" class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-medium shadow-sm transition hover:shadow">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
            Nuevo Usuario
        </a>
    </div>

    <!-- Users Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-lg font-bold text-slate-800">Usuarios Activos</h2>
            <span class="text-xs text-slate-400 font-medium">* Operaciones disponibles: Crear, Leer y Actualizar</span>
        </div>

        @if (isset($usuarios) && count($usuarios) > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-50/75 border-b border-slate-100 text-slate-500 uppercase text-xs tracking-wider">
                            <th class="py-3.5 px-6 font-semibold">Usuario</th>
                            <th class="py-3.5 px-6 font-semibold">Correo Electrónico</th>
                            <th class="py-3.5 px-6 font-semibold text-center">Tareas Asignadas</th>
                            <th class="py-3.5 px-6 font-semibold">Fecha Registro</th>
                            <th class="py-3.5 px-6 font-semibold text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($usuarios as $usuario)
                            <tr class="hover:bg-slate-50/70 transition">
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-indigo-100 text-indigo-700 font-bold flex items-center justify-center text-sm">
                                            {{ strtoupper(substr($usuario->name, 0, 1)) }}
                                        </div>
                                        <div class="font-semibold text-slate-800">{{ $usuario->name }}</div>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-slate-600">
                                    {{ $usuario->email }}
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">
                                        {{ method_exists($usuario, 'tareas') && $usuario->tareas ? $usuario->tareas->count() : 0 }} tareas
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-slate-500 text-xs">
                                    {{ $usuario->created_at ? $usuario->created_at->format('d/m/Y') : '-' }}
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <!-- Only edit / update (no delete) -->
                                    <a href="{{ url('/usuarios/' . $usuario->id . '/editar') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Editar
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <!-- Empty state -->
            <div class="py-16 px-4 text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <h3 class="text-base font-semibold text-slate-800 mb-1">No hay usuarios registrados</h3>
                <p class="text-sm text-slate-500 mb-6 max-w-sm mx-auto">Creá un nuevo usuario para empezar a asignarle tareas.</p>
                <a href="{{ url('/usuarios/crear') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-medium shadow-sm transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    Crear primer usuario
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
