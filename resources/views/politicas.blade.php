@extends('layouts.app')

@section('titulo')
    Políticas de Envío y Devoluciones | GhostCaps
@endsection

@section('contenido')

<div class="bg-neutral-50/60 min-h-screen py-12 sm:py-16">

    {{-- CABECERA --}}
    <section class="max-w-5xl mx-auto px-4 text-center mb-12 sm:mb-16">
        <p class="text-xs uppercase tracking-[0.3em] text-red-600 font-bold">Información de Compra</p>
        <h1 class="font-marker text-4xl sm:text-5xl lg:text-6xl tracking-wide text-neutral-900 mt-3">
            Envíos, Cambios y <span class="text-red-600">Garantías</span>
        </h1>
        <p class="mt-4 text-sm sm:text-base text-neutral-600 max-w-xl mx-auto leading-relaxed">
            Condiciones claras y transparentes para que compres tus gorras con total seguridad y respaldo.
        </p>
    </section>

    {{-- CUADRÍCULA DE POLÍTICAS --}}
    <section class="max-w-5xl mx-auto px-4 pb-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">

            {{-- 1. ENVÍOS NACIONALES --}}
            <div class="bg-white border border-neutral-200/90 rounded-2xl p-7 sm:p-8 shadow-sm transition-all duration-300 hover:shadow-md hover:border-neutral-300 flex flex-col justify-between">
                <div>
                    <span class="font-marker text-3xl text-red-600 block mb-2">01</span>
                    <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-neutral-900 mb-1">
                        Envíos Nacionales
                    </h2>
                    <p class="text-xs font-semibold uppercase tracking-wider text-neutral-400 mb-4">
                        Cobertura en toda Colombia
                    </p>
                    <div class="space-y-3 text-sm text-neutral-600 leading-relaxed">
                        <p>
                            <strong class="text-neutral-900 font-semibold">Tiempos de entrega:</strong> Para ciudades principales el tiempo estimado es de <span class="text-neutral-900 font-medium">2 a 4 días hábiles</span>. Para municipios y zonas especiales, entre 4 a 6 días hábiles.
                        </p>
                        <p>
                            <strong class="text-neutral-900 font-semibold">Transportadoras:</strong> Todos los paquetes se envían en caja rígida protectora a través de empresas certificadas como Interrapidísimo, Servientrega o Envía.
                        </p>
                        <p>
                            <strong class="text-neutral-900 font-semibold">Número de guía:</strong> Al despachar tu pedido recibirás tu número de rastreo vía WhatsApp o correo para consultar el estado del envío en tiempo real.
                        </p>
                    </div>
                </div>
            </div>

            {{-- 2. CAMBIOS Y TALLAS --}}
            <div class="bg-white border border-neutral-200/90 rounded-2xl p-7 sm:p-8 shadow-sm transition-all duration-300 hover:shadow-md hover:border-neutral-300 flex flex-col justify-between">
                <div>
                    <span class="font-marker text-3xl text-red-600 block mb-2">02</span>
                    <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-neutral-900 mb-1">
                        Cambios de Producto
                    </h2>
                    <p class="text-xs font-semibold uppercase tracking-wider text-neutral-400 mb-4">
                        Hasta 15 días calendario
                    </p>
                    <div class="space-y-3 text-sm text-neutral-600 leading-relaxed">
                        <p>
                            <strong class="text-neutral-900 font-semibold">Plazo de solicitud:</strong> Tienes hasta <span class="text-neutral-900 font-medium">15 días calendario</span> a partir de la fecha de entrega para pedir cambio por modelo, color o referencia.
                        </p>
                        <p>
                            <strong class="text-neutral-900 font-semibold">Condiciones del artículo:</strong> La gorra debe estar completamente nueva, sin señales de uso, con sus etiquetas, stickers originales y empaque protector intactos.
                        </p>
                        <p>
                            <strong class="text-neutral-900 font-semibold">Costos de transporte:</strong> Si el cambio es por gusto personal, el cliente cubre los fletes de envío. Si obedece a un error en el despacho de nuestra parte, GhostCaps asume el 100% de los envíos.
                        </p>
                    </div>
                </div>
            </div>

            {{-- 3. DERECHO DE RETRACTO --}}
            <div class="bg-white border border-neutral-200/90 rounded-2xl p-7 sm:p-8 shadow-sm transition-all duration-300 hover:shadow-md hover:border-neutral-300 flex flex-col justify-between">
                <div>
                    <span class="font-marker text-3xl text-red-600 block mb-2">03</span>
                    <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-neutral-900 mb-1">
                        Derecho de Retracto
                    </h2>
                    <p class="text-xs font-semibold uppercase tracking-wider text-neutral-400 mb-4">
                        Ley 1480 de 2011 (Colombia)
                    </p>
                    <div class="space-y-3 text-sm text-neutral-600 leading-relaxed">
                        <p>
                            De acuerdo con la legislación colombiana de comercio electrónico, puedes ejercer tu derecho al retracto dentro de los <span class="text-neutral-900 font-medium">5 días hábiles</span> posteriores a la recepción del pedido.
                        </p>
                        <p>
                            El producto debe ser devuelto en su empaque original y en perfecto estado. Una vez verificado en nuestras instalaciones, se gestiona el reembolso del dinero conforme a los plazos legales establecidos.
                        </p>
                    </div>
                </div>
            </div>

            {{-- 4. GARANTÍA DE FÁBRICA --}}
            <div class="bg-white border border-neutral-200/90 rounded-2xl p-7 sm:p-8 shadow-sm transition-all duration-300 hover:shadow-md hover:border-neutral-300 flex flex-col justify-between">
                <div>
                    <span class="font-marker text-3xl text-red-600 block mb-2">04</span>
                    <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-neutral-900 mb-1">
                        Garantía de Fábrica
                    </h2>
                    <p class="text-xs font-semibold uppercase tracking-wider text-neutral-400 mb-4">
                        30 días de cobertura
                    </p>
                    <div class="space-y-3 text-sm text-neutral-600 leading-relaxed">
                        <p>
                            Todas nuestras gorras cuentan con <span class="text-neutral-900 font-medium">30 días de garantía</span> frente a cualquier defecto de fabricación en costuras, broches o hebillas de ajuste.
                        </p>
                        <p>
                            <strong class="text-neutral-900 font-semibold">Exclusiones:</strong> La garantía no cubre deterioros causados por lavado a máquina, uso de detergentes abrasivos o desgaste accidental ajeno al proceso de fabricación.
                        </p>
                    </div>
                </div>
            </div>

        </div>

        {{-- TARJETA INFORMATIVA / CONTACTO --}}
        <div class="mt-8 rounded-2xl bg-neutral-900 text-white p-7 sm:p-9 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-sm">
            <div class="text-center sm:text-left">
                <h3 class="font-marker text-xl sm:text-2xl text-white">¿Tienes dudas sobre tu envío o producto?</h3>
                <p class="mt-1 text-xs sm:text-sm text-neutral-300">
                    Escríbenos directamente indicando tu número de pedido y te brindamos respuesta inmediata.
                </p>
            </div>
            <a href="https://wa.me/573172126545?text=Hola%20GhostCaps,%20tengo%20una%20consulta%20sobre%20mi%20pedido" 
               target="_blank" 
               rel="noopener"
               class="shrink-0 inline-flex items-center justify-center rounded-full bg-red-600 px-7 py-3 text-xs sm:text-sm font-bold uppercase tracking-wider text-white transition hover:bg-red-700 hover:scale-105 shadow-md">
                Contactar por WhatsApp
            </a>
        </div>

    </section>

</div>

@endsection