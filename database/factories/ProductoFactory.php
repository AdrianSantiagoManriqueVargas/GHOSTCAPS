<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\ImagenProducto;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Producto>
 */
class ProductoFactory extends Factory
{

    public function definition(): array
    {
        return [
            'nombre_producto' => 'Gorra Adidas',
            'descripcion_producto' => 'Gorra deportiva clásica de algodón, ajustable, ideal para uso diario.',
            'color' => 'Negro',
            'precio' => fake()->numberBetween(40, 60) * 1000,
            'stock' => fake()->numberBetween(5, 20),
            'id_categoria' => Categoria::inRandomOrder()->first()->id,
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Producto $producto) {
            ImagenProducto::create([
                'id_producto' => $producto->id,
                'url_imagen' => 'productos/gorra-adidas-3L.jpg',
            ]);
        });
    }
}
