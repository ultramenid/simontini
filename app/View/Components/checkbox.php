<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Checkbox extends Component
{
    public $idAttribute;
    public $layerName;
    /**
     * Create a new component instance.
     */
    public function __construct($idAttr, $layerName)
    {
        $this->idAttribute = $idAttr;
        $this->layerName = $layerName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.checkbox');
    }
}
