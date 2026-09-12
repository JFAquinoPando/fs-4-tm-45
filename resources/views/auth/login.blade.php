@extends('layouts.app')

@section('title', 'Iniciar Sesión - TaskHub')

@section('content')
<div class="min-h-[70vh] flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 mb-4 shadow-sm">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Iniciar Sesión</h2>
            <p class="mt-2 text-sm text-slate-500">
                ¿No tenés una cuenta todavía?
                <a href="{{ url('/usuarios/crear') }}" class="font-semibold text-indigo-600 hover:text-indigo-500 transition">
                    Crear usuario
                </a>
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-6 shadow-sm border border-slate-200 rounded-2xl sm:px-10">
                <form action="{{ url('/login') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700">
                            Correo electrónico
                        </label>
                        <div class="mt-1.5 relative">
                            <input
                                id="email"
                                name="email"
                                type="email"
                                autocomplete="email"
                                required
                                value="{{ old('email') }}"
                                class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                placeholder="tu@email.com"
                            >
                        </div>
                        @error('email')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-semibold text-slate-700">
                                Contraseña
                            </label>
                        </div>
                        <div class="mt-1.5">
                            <input
                                id="password"
                                name="password"
                                type="password"
                                autocomplete="current-password"
                                required
                                class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                placeholder="••••••••"
                            >
                        </div>
                        @error('password')
                            <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Recordarme -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input
                                id="remember_me"
                                name="remember"
                                type="checkbox"
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-slate-300 rounded cursor-pointer"
                            >
                            <label for="remember_me" class="ml-2 block text-sm text-slate-600 cursor-pointer">
                                Recordarme en este equipo
                            </label>
                        </div>
                    </div>

                    <!-- Botón Ingresar -->
                    <div>
                        <button
                            type="submit"
                            class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition"
                        >
                            Ingresar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
