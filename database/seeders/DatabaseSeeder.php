<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\ColorProducto;
use App\Models\ImagenProducto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. USUARIO ADMINISTRADOR
        User::updateOrCreate(
            ['email' => 'adrian4santiago@gmail.com'],
            [
                'name'     => 'Admin GhostCaps',
                'password' => Hash::make('Admin1234*'),
            ]
        );

        // 2. CATEGORÍAS
        $catGoorin = Categoria::updateOrCreate(
            ['id' => 1],
            ['nombre_categoria' => 'Goorin Bros', 'descripcion_categoria' => 'Gorras estilo camionero clásicas con parches icónicos de animales.', 'imagen_portada' => 'categorias/vLpE72VGDNOg0BevCtWg3Hyh9JZpfCBkk7nW4IR0.webp']
        );

        $catEspeciales = Categoria::updateOrCreate(
            ['id' => 2],
            ['nombre_categoria' => 'Ediciones Especiales', 'descripcion_categoria' => 'Piezas exclusivas, colaboraciones y modelos de colección limitada.', 'imagen_portada' => 'categorias/pN1iZdSurpd0tHrMWoieJRIIdun1rxZMK4cTmjHz.jpg']
        );

        $catLooney = Categoria::updateOrCreate(
            ['id' => 3],
            ['nombre_categoria' => 'Looney Tunes', 'descripcion_categoria' => 'Colección oficial animada de Warner Bros y Looney Tunes.', 'imagen_portada' => 'categorias/5AUk6CnctCsXxQHKLQZHVm0uJCKprM3vWtpgLbms.webp']
        );

        $catNaruto = Categoria::updateOrCreate(
            ['id' => 4],
            ['nombre_categoria' => 'Naruto', 'descripcion_categoria' => 'Diseños inspirados en los shinobis y aldeas del universo Naruto.', 'imagen_portada' => 'categorias/9EOrVwXFFUBvb3kP0Lu6zCh1GN4bQlEwJa0u9w2S.webp']
        );

        $catJG = Categoria::updateOrCreate(
            ['id' => 5],
            ['nombre_categoria' => 'JG', 'descripcion_categoria' => 'Estilo urbano auténtico con tipografías y bordados JG.', 'imagen_portada' => 'categorias/4lRR9Dg17cGRGN7k3VvVI6WwlWn42vWYFc13vgYI.webp']
        );

        // 3. PRODUCTOS, COLORES E IMÁGENES
        $gorras = [
            [
                'id' => 1, 'id_categoria' => $catGoorin->id, 'nombre_producto' => 'UNDISPUTED GOAT', 'precio' => 55000, 'stock' => 1,
                'descripcion_producto' => 'Gorra trucker Goorin Bros The Farm con parche frontal The Goat.',
                'colores' => [['nombre_color' => 'Negro', 'codigo_hex' => '#000000'], ['nombre_color' => 'Rojo', 'codigo_hex' => '#DC2626']],
                'imagenes' => ['productos/inUN8yb63QLwkMLpIIt4EkPExiiedhCnDSkyJFLl.webp', 'productos/pTqxCyB1KLslQkCRaN0ibggR8D7i8tRDNXEBBf41.webp']
            ],
            [
                'id' => 2, 'id_categoria' => $catJG->id, 'nombre_producto' => 'JG LETTERING VOL 2', 'precio' => 52000, 'stock' => 5,
                'descripcion_producto' => 'Gorra streetwear JG con bordado tipográfico de alta densidad.',
                'colores' => [['nombre_color' => 'Azul', 'codigo_hex' => '#1E3A8A']],
                'imagenes' => ['productos/Trx1qHW84HG2BcUGSjwRtpfa5BewdY9Cv4s68oEl.webp', 'productos/2KoOAUmMCKQiKwZOVdXsCdCcScuIifpbpgfEnW9W.webp']
            ],
            [
                'id' => 3, 'id_categoria' => $catJG->id, 'nombre_producto' => 'JG LETTERING VOL 2', 'precio' => 52000, 'stock' => 0,
                'descripcion_producto' => 'Gorra streetwear JG en tono morado de edición limitada.',
                'colores' => [['nombre_color' => 'Morado', 'codigo_hex' => '#6B21A8']],
                'imagenes' => ['productos/QLNtgKXb5el5Fr0lFmUd4eKlTZM83zFXtnynLo60.webp', 'productos/NCnMge6mH6mhcgOW2naorfZtOk15OngYiloWSDvN.webp']
            ],
            [
                'id' => 4, 'id_categoria' => $catLooney->id, 'nombre_producto' => 'Looney Tunes | Classic Logos', 'precio' => 60000, 'stock' => 3,
                'descripcion_producto' => 'Gorra negra clásica con los logos retro de Looney Tunes.',
                'colores' => [['nombre_color' => 'Negro', 'codigo_hex' => '#000000']],
                'imagenes' => ['productos/CcEUxwYZrY8oCXO7bm22rwqcXbP8dMRgdza3hgkY.webp', 'productos/pM0OLrMPaSsyJ91sCZ39wOGMc0ZaEAflUSIJZj2O.webp']
            ],
            [
                'id' => 5, 'id_categoria' => $catLooney->id, 'nombre_producto' => 'LOONEY TUNES | LOLA BUNNY', 'precio' => 60000, 'stock' => 4,
                'descripcion_producto' => 'Diseño exclusivo bordado de Lola Bunny sobre visera curva.',
                'colores' => [['nombre_color' => 'Negro', 'codigo_hex' => '#000000']],
                'imagenes' => ['productos/M9U8D8Jsg6Al4Tuee8JCUQxSZ6fJHrR8Pmlv8brq.webp', 'productos/AKRcTclEq1c5mhUkHkcTwaCmpDNFKiXTxgaj2OQh.webp']
            ],
            [
                'id' => 6, 'id_categoria' => $catLooney->id, 'nombre_producto' => 'LOONEY TUNES NEW WAVE | YOSEMITE SAM', 'precio' => 62000, 'stock' => 3,
                'descripcion_producto' => 'Edición New Wave Yosemite Sam con tonos azules y bordado frontal.',
                'colores' => [['nombre_color' => 'Azul', 'codigo_hex' => '#2563EB']],
                'imagenes' => ['productos/NMgV4GdCQBJSAMmj3j9kHPOQTq1ULEAh5P1kzjlP.webp', 'productos/vKf1cndUmwd1nrxrFAz5jXStSBh5g8V1JtG7NfSh.webp']
            ],
            [
                'id' => 7, 'id_categoria' => $catLooney->id, 'nombre_producto' => 'LOONEY TUNES NEW WAVE | GOSSAMER', 'precio' => 62000, 'stock' => 4,
                'descripcion_producto' => 'Edición Gossamer en color amarillo llamativo.',
                'colores' => [['nombre_color' => 'Amarillo', 'codigo_hex' => '#EAB308']],
                'imagenes' => ['productos/jRkbgSfgrDFpKYWpDEr5TPaIiUpUMZAHHQ00TAQ6.webp', 'productos/9BbCGWG9znyCoNhHxZCNTcD40CQ9R9VHBYTBVF0q.webp']
            ],
            [
                'id' => 8, 'id_categoria' => $catNaruto->id, 'nombre_producto' => 'NARUTO SHINOBIS | KILLER BEE', 'precio' => 65000, 'stock' => 1,
                'descripcion_producto' => 'Gorra blanca temática de Killer Bee, el jinchuriki del ocho colas.',
                'colores' => [['nombre_color' => 'Blanco', 'codigo_hex' => '#FFFFFF']],
                'imagenes' => ['productos/tl9EiHefsBFDFAyXvuQDDWBTClB1KMY11pluQbnK.webp', 'productos/UTkBgp9rwr7MFs8RIv5OnrERDoGkImZEQSRMZA2Q.webp']
            ],
            [
                'id' => 9, 'id_categoria' => $catNaruto->id, 'nombre_producto' => 'NARUTO SHINOBIS | GAARA', 'precio' => 65000, 'stock' => 10,
                'descripcion_producto' => 'Gorra temática de Gaara del desierto con parche kanji de Amor.',
                'colores' => [['nombre_color' => 'Naranja', 'codigo_hex' => '#F97316'], ['nombre_color' => 'Rojo', 'codigo_hex' => '#DC2626']],
                'imagenes' => ['productos/hWYQZADJ26a8zFZszLzqldv5vJsjTCQjdYsqqtmY.webp', 'productos/hs1QuCJbD6M1quLl23PfzGyRRGNGowXF78XZSreF.webp']
            ],
            [
                'id' => 10, 'id_categoria' => $catJG->id, 'nombre_producto' => 'JG RUNAS', 'precio' => 50000, 'stock' => 1,
                'descripcion_producto' => 'Diseño exclusivo con runas nórdicas y estética underground.',
                'colores' => [['nombre_color' => 'Negro', 'codigo_hex' => '#000000']],
                'imagenes' => ['productos/jCVVGhtje1PqJP2jgwGm7OEAui3vwXayyWzET2wG.webp', 'productos/ASaE25O6JcmWLLXssaxSLHcCxZlMW7skAQ8hKCeB.webp']
            ],
            [
                'id' => 13, 'id_categoria' => $catEspeciales->id, 'nombre_producto' => 'Mitchell & Ness | Las Vegas Raiders', 'precio' => 70000, 'stock' => 2,
                'descripcion_producto' => 'Gorra oficial NFL Mitchell & Ness Raiders con visera plana clásica.',
                'colores' => [['nombre_color' => 'Negro', 'codigo_hex' => '#000000'], ['nombre_color' => 'Gris', 'codigo_hex' => '#6B7280']],
                'imagenes' => ['productos/WMbInREXPoZPeL5zQijJArINAi70tJ08BB5AS4Nm.jpg']
            ],
            [
                'id' => 14, 'id_categoria' => $catEspeciales->id, 'nombre_producto' => 'Mitchell & Ness | Philadelphia 76ers', 'precio' => 70000, 'stock' => 2,
                'descripcion_producto' => 'Gorra retro Mitchell & Ness NBA Philadelphia 76ers en tono negro.',
                'colores' => [['nombre_color' => 'Negro', 'codigo_hex' => '#000000']],
                'imagenes' => ['productos/rjcuLquTt6yy2xKIf5piDVoQd7wR7st5dDhlv4Wu.webp']
            ],
        ];

        foreach ($gorras as $g) {
            $producto = Producto::updateOrCreate(
                ['id' => $g['id']],
                [
                    'id_categoria'         => $g['id_categoria'],
                    'nombre_producto'      => $g['nombre_producto'],
                    'descripcion_producto' => $g['descripcion_producto'],
                    'precio'               => $g['precio'],
                    'stock'                => $g['stock'],
                ]
            );

            // Colores
            foreach ($g['colores'] as $c) {
                ColorProducto::firstOrCreate([
                    'id_producto'  => $producto->id,
                    'nombre_color' => $c['nombre_color'],
                    'codigo_hex'   => $c['codigo_hex'],
                ]);
            }

            // Imágenes
            foreach ($g['imagenes'] as $img) {
                ImagenProducto::firstOrCreate([
                    'id_producto' => $producto->id,
                    'url_imagen'  => $img,
                ]);
            }
        }
    }
}