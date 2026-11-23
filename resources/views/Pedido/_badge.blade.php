@if ($estado === 'Entregado')
    <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200/50 text-sm font-medium px-3 py-1 rounded-full">
        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
        Entregado
    </span>
@elseif ($estado === 'Cancelado')
    <span class="inline-flex items-center gap-1.5 bg-red-50 text-red-600 border border-red-200/50 text-sm font-medium px-3 py-1 rounded-full">
        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
        Cancelado
    </span>
@else
    <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-700 border border-amber-200/50 text-sm font-medium px-3 py-1 rounded-full">
        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
        Pendiente
    </span>
@endif