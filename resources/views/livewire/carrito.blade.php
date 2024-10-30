<div>
    <h2>Tu carrito</h2>
    <ul>
        @foreach ($carrito as $item)
            <li>{{ $item['nombre'] }} - Cantidad: {{ $item['cantidad'] }} - Precio: ${{ $item['precio'] }}</li>
        @endforeach
    </ul>
    <p>Subtotal: ${{ $subtotal }}</p>
    <p>Total: ${{ $total }}</p>
</div>
