<!-- <style>
    .bg-indigo-700{
        background-color: indigo;
        color: whitesmoke;
    }

    .bg-esmerald-700{
        background-color: green;
        color: whitesmoke;
    }
</style> -->
<div class="bg-green-700"></div>
<div class="bg-{{ $tipo === "maxima" ? "indigo" : "green" }}-700">
    <h1 class="text-2xl">{{ $titulo }}</h1>
    @if ($imagen !== "")
    <picture>
        <img src="{{ $imagen }}" alt="{{ $titulo }}" class="w-48 aspect-square object-cover">
    </picture>
    @endif
    <p>
        {{ $slot }} + {{ $ejemplo }}
    </p>
</div>