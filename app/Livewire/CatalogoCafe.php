<?php

namespace App\Livewire;

use App\Models\Producto;
use Livewire\Component;

class CatalogoCafe extends Component
{
    public $productos;

            // Obtiene todos los productos de la base de datos y los almacena en la variable de Livewire

    public function mount()
    {
        $this->productos = Producto::all();
    }
    public function agregarAlCarrito($productoId)
    {
        $carrito = session()->get('carrito', []);
        $producto = Producto::find($productoId);

        if (!$producto) {
            session()->flash('error', 'Producto no encontrado.');
            return;
        }

        if (isset($carrito[$productoId])) {
            $carrito[$productoId]['cantidad']++;
        } else {
            $carrito[$productoId] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => 1,
            ];
        }

        session()->put('carrito', $carrito);
        $this->emit('actualizarCarrito');
    }


    public function render()
    {
        return view('livewire.catalogo-cafe');
    }
}
