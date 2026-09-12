@extends('layouts.app')

@section('title', 'Editar Usuario - TaskHub')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Editar Usuario</h1>
            <p class="text-sm text-slate-500 mt-1">Actualizá los datos del perfil de usuario.</p>
        </div>
        <a href="{{ url('/usuarios') }}" class="inline-flex items-center text-sm font-medium text-slate-600 hover:text-indigo-600 transition">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Volver a usuarios
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
        <form action="{{ url('/usuarios/' . $usuario->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nombre -->
            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">
                    Nombre completo <span class="text-rose-500">*</span>
                </label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $usuario->name) }}"
                    required
                    class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                >
                @error('name')
                    <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                    Correo electrónico <span class="text-rose-500">*</span>
                </label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email', $usuario->email) }}"
                    required
                    class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                >
                @error('email')
                    <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Grid (Opcional al editar) -->
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-4">
                <span class="block text-xs font-bold uppercase tracking-wider text-slate-500">Cambiar Contraseña (opcional)</span>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">
                            Nueva contraseña
                        </label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                            placeholder="Dejar en blanco para no cambiar"
                        >
                        @error('password')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-2">
                            Confirmar nueva contraseña
                        </label>
                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                            placeholder="Repetir nueva contraseña"
                        >
                    </div>
                </div>
            </div>

            <!-- Actions (NO delete button - only update/cancel) -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ url('/usuarios') }}" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition">
                    Cancelar
                </a>
                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl font-semibold shadow-sm transition hover:shadow focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Actualizar Usuario
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
