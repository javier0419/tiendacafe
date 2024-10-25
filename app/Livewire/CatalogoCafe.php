<?php

namespace App\Livewire;

use App\Models\Producto;
use Livewire\Component;

class CatalogoCafe extends Component
{
    public $productos;

    public function mount()
    {
        $this->productos = Producto::all();
    }


    public function render()
    {
        return view('livewire.catalogo-cafe');
    }
}
