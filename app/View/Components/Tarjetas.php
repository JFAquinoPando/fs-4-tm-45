<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tarjetas extends Component
{
    public $fondoColor;
    public $icono;
    public $titulo;
    /**
     * Create a new component instance.
     */
    public function __construct($fondoColor = "amber", $icono = "", $titulo = "----")
    {
        $this->fondoColor = $fondoColor;
        $this->icono = $icono;
        $this->titulo = $titulo;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tarjetas');
    }
}
