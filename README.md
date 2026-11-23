<p align="center">
  <img src="public/img/logo.png" alt="GhostCaps Icon" width="130">
  <br>
  <img src="public/img/logo-letras.png" alt="GhostCaps Letras" width="280">
</p>

<h1 align="center">GHOSTCAPS</h1>

<p align="center">
  <strong>Plataforma E-Commerce y Sistema de Gestión de Inventario para Moda Urbana y Gorras de Colección</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2">
  <img src="https://img.shields.io/badge/Tailwind_CSS-v4.0-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/Vite-7.x-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite">
  <img src="https://img.shields.io/badge/SQLite-07405E?style=for-the-badge&logo=sqlite&logoColor=white" alt="SQLite">
</p>

---

## 📌 Acerca del Proyecto

**GHOSTCAPS** es una solución web integral diseñada para erradicar la informalidad, la sobreventa y la falta de trazabilidad en la comercialización de accesorios streetwear y gorras de colección. Combina una experiencia de compra autónoma, ágil y visual para el cliente con un panel de control administrativo robusto para la operación del negocio.

Proyecto desarrollado como trabajo formativo para el programa **Tecnólogo en Análisis y Desarrollo de Software (ADSO)** en el **Servicio Nacional de Aprendizaje (SENA)**.

---

## ✨ Características Principales

### 🛒 Tienda Pública (Experiencia del Cliente)
- **Hero Interactivo & Bento Grid:** Destacados automáticos (*Más Vendidas, Lo Nuevo, Últimas Unidades y Tendencias*) y video con reproducción optimizada por visibilidad.
- **Rack de Gorras 3D/CSS:** Exhibición visual interactiva con física pendular de balanceo (*swinging*).
- **Catálogo Inteligente:** Filtros dinámicos combinados por rango de precio, paletas cromáticas hexadecimales, categorías y buscador por coincidencia textual.
- **Psicología de Stock (FOMO):** Alertas visuales dinámicas de escasez (*"¡Alta demanda! Solo queda 1 unidad"*, *"Pocas unidades"* o *"Agotado temporalmente"*).
- **Carrito Persistente:** Control de cantidades con validación automática de existencias y prevención de trampas en el botón de retroceso.
- **Checkout Asistido vía WhatsApp:** Formalización estructurada de la orden recopilando datos de envío y facturación, con enlace universal a la API de WhatsApp (`wa.me`) para coordinar transferencias directas (Nequi, Daviplata, Bancolombia).
- **Políticas Institucionales:** Módulo formal alineado con la Ley 1480 de 2011 (Estatuto del Consumidor, Envíos y Derecho de Retracto).

### ⚙️ Panel de Gestión (Administrador)
- **Dashboard Operativo:** Métricas en tiempo real de ingresos por pedidos entregados, órdenes pendientes, directorio de clientes y alertas de stock crítico (≤ 2 unidades).
- **Gestión de Catálogo (CRUDs):** Administración completa de productos con soporte para múltiples fotografías por artículo, asignación de colores y categorías con portadas de colección.
- **Separación de Stock y Estado:** Monitoreo claro de unidades físicas numéricas vs. estado cualitativo (*Disponible, Stock Bajo, Agotado*).
- **Gestión de Pedidos y Ciclo de Vida:** Seguimiento de órdenes (*Pendiente, Entregado, Cancelado*) con reversión o descuento automático de inventario físico.
- **Directorio de Clientes:** Búsqueda rápida por nombre, documento de identidad, teléfono o ciudad.

---

## 🛡️ Arquitectura y Seguridad

- **Arquitectura en Capas (Repository-Service Pattern):** Desacoplamiento estricto entre controladores HTTP, lógica de negocio y capas de persistencia.
- **Inyecciones SQL:** 100% blindado mediante consultas preparadas con PDO a través del ORM Eloquent.
- **Protección XSS & CSRF:** Escape estricto en plantillas Blade (`{{ }}`) y tokens obligatorios `@csrf` en todas las operaciones mutables.
- **Rate Limiting:** Control de intentos en inicio de sesión (bloqueo temporal de 60s tras 5 intentos fallidos) y en procesamiento de órdenes.
- **Integridad Transaccional:** Uso de transacciones atómicas (`DB::transaction`) para garantizar que la deducción de inventario y la creación de la orden sean indivisibles.

---

## 🚀 Guía de Instalación Local

### Requisitos Previos
- PHP >= 8.2 con extensiones activas (`pdo`, `sqlite3`, `mbstring`, `fileinfo`)
- Composer >= 2.x
- Node.js >= 18.x y npm

### Pasos de Despliegue
```bash
# 1. Clonar el repositorio
git clone -b Developer https://github.com/AdrianSantiagoManriqueVargas/GHOSTCAPS.git
cd GHOSTCAPS

# 2. Instalar dependencias del backend y frontend
composer install
npm install

# 3. Configurar entorno y generar llave de aplicación
cp .env.example .env
php artisan key:generate

# 4. Enlazar almacenamiento público de imágenes
php artisan storage:link

# 5. Ejecutar migraciones y semillero (crea admin, categorías y catálogo de gorras)
php artisan migrate:fresh --seed

# 6. Compilar estilos de Tailwind CSS
npm run build

# 7. Iniciar el servidor local
php artisan serve
```

---

## 🔐 Acceso Administrativo (Entorno Local)

Para acceder al panel de gestión en `http://127.0.0.1:8000/login` en un entorno de desarrollo local, el sistema genera automáticamente el usuario inicial tras ejecutar el comando `php artisan migrate:fresh --seed`.

*(Los parámetros de demostración para pruebas locales están definidos dentro del semillero en `database/seeders/DatabaseSeeder.php`).*

---

## 👨‍💻 Autor

**Adrian Santiago Manrique Vargas**  
*Tecnólogo en Análisis y Desarrollo de Software (ADSO)*  
Centro Agroempresarial y Turístico de los Andes (SENA - CATA)  
Málaga, Santander, Colombia.