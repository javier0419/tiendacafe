<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Café</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    @livewireStyles
</head>
<body>

<div>
<div class="container">
    <div class="row">
        @foreach ($productos as $producto)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{  $producto->imagen }}" class="card-img-top" alt="{{ $producto->nombre }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                        <p class="card-text text-truncate">{{ $producto->descripcion }}</p>
                        <p class="card-text">Precio: ${{ $producto->precio }}</p>
                        <p class="card-text">Stock: {{ $producto->stock }}</p>
                        <button type="button" class="btn btn-primary" wire:click="agregarAlCarrito({{ $producto->id }})">
                            Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="container mt-4">
    <livewire:carrito />
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
@livewireScripts

</body>
</html>
