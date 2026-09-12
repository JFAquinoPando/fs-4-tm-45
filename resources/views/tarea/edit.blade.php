@extends('layouts.app')

@section('title', 'Editar Tarea - TodoList')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Editar Tarea</h1>
            <p class="text-sm text-slate-500 mt-1">Actualizá los datos de tu actividad.</p>
        </div>
        <a href="{{ url('/tareas') }}" class="inline-flex items-center text-sm font-medium text-slate-600 hover:text-indigo-600 transition">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Volver a la lista
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
        <form action="{{ url('/tareas/' . $tarea->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Descripción -->
            <div>
                <label for="descripcion" class="block text-sm font-semibold text-slate-700 mb-2">
                    Descripción de la actividad <span class="text-rose-500">*</span>
                </label>
                <textarea
                    name="descripcion"
                    id="descripcion"
                    rows="3"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                    required
                >{{ old('descripcion', $tarea->descripcion) }}</textarea>
                @error('descripcion')
                    <p class="mt-1.5 text-xs text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Opciones / Toggles -->
            <div class="bg-slate-50 rounded-xl p-4 border border-slate-200 space-y-4">
                <span class="block text-xs font-bold uppercase tracking-wider text-slate-500">Configuración de la tarea</span>

                <!-- Prioridad -->
                <div class="flex items-center justify-between">
                    <div>
                        <label for="prioridad" class="text-sm font-semibold text-slate-800 cursor-pointer">Alta Prioridad</label>
                        <p class="text-xs text-slate-500">Marcala si requiere atención urgente.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input
                            type="checkbox"
                            name="prioridad"
                            id="prioridad"
                            value="1"
                            {{ old('prioridad', $tarea->prioridad) ? 'checked' : '' }}
                            class="sr-only peer"
                        >
                        <div class="w-11 h-6 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-rose-500"></div>
                    </label>
                </div>

                <div class="border-t border-slate-200"></div>

                <!-- Realizado -->
                <div class="flex items-center justify-between">
                    <div>
                        <label for="realizado" class="text-sm font-semibold text-slate-800 cursor-pointer">Estado: Realizada</label>
                        <p class="text-xs text-slate-500">Marcá si la actividad ya fue completada.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input
                            type="checkbox"
                            name="realizado"
                            id="realizado"
                            value="1"
                            {{ old('realizado', $tarea->realizado) ? 'checked' : '' }}
                            class="sr-only peer"
                        >
                        <div class="w-11 h-6 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                    </label>
                </div>
            </div>

            <!-- Actions (NO delete button - only update/cancel) -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ url('/tareas') }}" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition">
                    Cancelar
                </a>
                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl font-semibold shadow-sm transition hover:shadow focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Actualizar Tarea
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
