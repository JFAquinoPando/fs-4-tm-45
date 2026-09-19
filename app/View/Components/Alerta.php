<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alerta extends Component
{
    public $titulo;
    public $tipo;
    public $imagen;
    /**
     * Create a new component instance.
     */
    public function __construct(
            $titulo = "Un título de alerta", 
            $tipo = "maxima",
            $imagen = "")
    {
        $this->titulo = $titulo;
        $this->tipo = $tipo;
        $this->imagen = $imagen;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alerta', ["ejemplo" => 123]);
    }
}
