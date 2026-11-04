<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; color: #111;">

    <h1 style="font-size: 22px; margin-bottom: 4px;">Nuevo pedido #{{ $pedido->id }}</h1>
    <p style="color: #666; margin-top: 0;">{{ $pedido->created_at->format('d/m/Y h:i A') }}</p>

    <h2 style="font-size: 16px; margin-top: 24px;">Cliente</h2>
    <p style="margin: 0; line-height: 1.6;">
        {{ $pedido->cliente->nombre_cliente }}<br>
        {{ $pedido->cliente->tipo_documento }} {{ $pedido->cliente->numero_documento }}<br>
        Tel: {{ $pedido->cliente->telefono_cliente }}<br>
        {{ $pedido->cliente->direccion }}, {{ $pedido->cliente->ciudad }}
    </p>

    <h2 style="font-size: 16px; margin-top: 24px;">Productos</h2>
    <table style="width: 100%; border-collapse: collapse;">
        @foreach ($pedido->detalle_pedido as $detalle)
            <tr>
                <td style="padding: 8px 0; border-bottom: 1px solid #eee;">
                    {{ $detalle->cantidad }} x {{ $detalle->producto?->nombre_producto ?? 'Producto eliminado' }}
                </td>
                <td style="padding: 8px 0; border-bottom: 1px solid #eee; text-align: right;">
                    ${{ number_format($detalle->subtotal_detalle, 0, ',', '.') }}
                </td>
            </tr>
        @endforeach
    </table>

    <p style="text-align: right; line-height: 1.6;">
        Subtotal: ${{ number_format($pedido->subtotal, 0, ',', '.') }}<br>
        Envío: ${{ number_format($pedido->costo_envio, 0, ',', '.') }}<br>
        <strong style="font-size: 18px;">Total: ${{ number_format($pedido->total, 0, ',', '.') }}</strong>
    </p>

    <p style="margin-top: 28px;">
        <a href="{{ route('pedido.show', $pedido->id) }}"
           style="background: #000; color: #fff; padding: 12px 24px; border-radius: 999px; text-decoration: none; font-weight: bold;">
            Ver pedido en gestión
        </a>
    </p>

</div>