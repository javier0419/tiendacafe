<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Producto;

class Carrito extends Component
{
    public $carrito = [];
    public $subtotal = 0;
    public $total = 0;

    public function mount()
    {
        // Obtener el carrito de la sesión o inicializar como un arreglo vacío
        $this->carrito = session()->get('carrito', []);
        $this->calcularTotales();
    }

    public function render()
    {
        return view('livewire.carrito', [
            'carrito' => $this->carrito,
            'subtotal' => $this->subtotal,
            'total' => $this->total,
        ]);
    }

    public function agregarAlCarrito($productoId)
    {
        // Encontrar el producto en la base de datos
        $producto = Producto::find($productoId);

        if (!$producto) {
            session()->flash('error', 'El producto no existe.');
            return;
        }

        // Verificar si el producto ya está en el carrito
        if (isset($this->carrito[$productoId])) {
            // Si ya existe, incrementar la cantidad
            $this->carrito[$productoId]['cantidad']++;
        } else {
            // Si no existe, agregarlo con la cantidad inicial de 1
            $this->carrito[$productoId] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => 1,
            ];
        }

        // Actualizar el carrito en la sesión
        session()->put('carrito', $this->carrito);

        // Recalcular los totales
        $this->calcularTotales();

        // Emitir evento para actualizar otros componentes si es necesario
        $this->emit('actualizarCarrito');
    }

    private function calcularTotales()
    {
        $this->subtotal = 0;

        foreach ($this->carrito as $item) {
            $this->subtotal += $item['precio'] * $item['cantidad'];
        }

        $this->total = $this->subtotal;
    }
}
