<div {{ $attributes->merge(["class" => "bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4"]) }}>
    <div class="w-12 h-12 rounded-xl bg-{{ $fondoColor }}-50 text-{{ $fondoColor }}-600 flex items-center justify-center font-bold">
        @if(file_exists(public_path('images/' . $icono)))
            {!! file_get_contents(public_path('images/' . $icono)) !!}
        @endif
    </div>
    <div>
        <p class="text-xs uppercase tracking-wider text-slate-500 font-semibold">{{$titulo}}</p>
        <p class="text-2xl font-bold text-slate-800">
        {{ $slot }}    
        </p>
    </div>
</div>