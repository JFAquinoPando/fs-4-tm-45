@extends('layouts.app')

@section('title', 'Lista de Tareas - TodoList')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-slate-200">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Mis Tareas</h1>
            <p class="text-sm text-slate-500 mt-1">Administrá tus actividades diarias de forma clara y organizada.</p>
        </div>
        <a href="{{ url('/formulario-tarea') }}" class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-medium shadow-sm transition hover:shadow">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nueva Tarea
        </a>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <div>
                <p class="text-xs uppercase tracking-wider text-slate-500 font-semibold">Total</p>
                <p class="text-2xl font-bold text-slate-800">{{ isset($tareas) ? count($tareas) : 0 }}</p>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div>
                <p class="text-xs uppercase tracking-wider text-slate-500 font-semibold">Realizadas</p>
                <p class="text-2xl font-bold text-slate-800">{{ isset($tareas) ? $tareas->where('realizado', true)->count() : 0 }}</p>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs uppercase tracking-wider text-slate-500 font-semibold">Pendientes</p>
                <p class="text-2xl font-bold text-slate-800">{{ isset($tareas) ? $tareas->where('realizado', false)->count() : 0 }}</p>
            </div>
        </div>
    </div>

    <!-- Task List -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-lg font-bold text-slate-800">Listado de Actividades</h2>
            <span class="text-xs text-slate-400 font-medium">* Operaciones disponibles: Crear, Leer y Actualizar</span>
        </div>

        @if (isset($tareas) && count($tareas) > 0)
            <div class="divide-y divide-slate-100">
                @foreach ($tareas as $tarea)
                    <div class="p-5 hover:bg-slate-50/80 transition flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex items-start gap-4">
                            <!-- Toggle Realizado Form -->
                            <form action="{{ url('/tareas/' . $tarea->id . '/toggle') }}" method="POST" class="mt-1">
                                @csrf
                                @method('PATCH')
                                <button type="submit" title="{{ $tarea->realizado ? 'Marcar como pendiente' : 'Marcar como realizada' }}" class="w-6 h-6 rounded-lg border-2 flex items-center justify-center transition {{ $tarea->realizado ? 'bg-emerald-500 border-emerald-500 text-white' : 'border-slate-300 hover:border-indigo-500 text-transparent' }}">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </form>

                            <div class="space-y-1">
                                <p class="text-base font-medium {{ $tarea->realizado ? 'line-through text-slate-400' : 'text-slate-800' }}">
                                    {{ $tarea->descripcion }}
                                </p>
                                <div class="flex flex-wrap items-center gap-2">
                                    <!-- Prioridad Badge -->
                                    @if ($tarea->prioridad)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-700">
                                            Alta prioridad
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-600">
                                            Prioridad normal
                                        </span>
                                    @endif

                                    <!-- Estado Badge -->
                                    @if ($tarea->realizado)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">
                                            Completada
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">
                                            Pendiente
                                        </span>
                                    @endif

                                    @if ($tarea->usuarios)
                                        <span class="text-xs text-slate-400">
                                            Asignado a: <strong class="text-slate-600 font-medium">{{ $tarea->usuarios->name }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Action: Actualizar / Editar -->
                        <div class="flex items-center gap-2 self-end sm:self-center">
                            <a href="{{ url('/tareas/' . $tarea->id . '/editar') }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-sm font-medium text-indigo-600 bg-indigo-50 hover:bg-indigo-100 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Editar
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty state -->
            <div class="py-16 px-4 text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-base font-semibold text-slate-800 mb-1">No tenés tareas registradas todavía</h3>
                <p class="text-sm text-slate-500 mb-6 max-w-sm mx-auto">Empezá agregando una actividad para organizar tus pendientes de forma eficiente.</p>
                <a href="{{ url('/formulario-tarea') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-medium shadow-sm transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Crear primera tarea
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
