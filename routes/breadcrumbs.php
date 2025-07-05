<?php

use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Spatie\Permission\Models\Role;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('dashboard'));
});

// Home > Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Dashboard', route('dashboard'));
});




// Home > Dashboard > Ventas
Breadcrumbs::for('ventas.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard'); // Change this if your actual parent is 'home' or something else
    $trail->push('Ventas', route('ventas.index'));
});

// Home > Dashboard > Ventas > Punto de venta
Breadcrumbs::for('ventas.punto-de-venta', function (BreadcrumbTrail $trail) {
    $trail->parent('ventas.index');
    $trail->push('Punto de venta', route('ventas.punto-de-venta'));
});

// Home > Dashboard > Ventas > Notas de Venta
Breadcrumbs::for('ventas.notas-de-venta', function (BreadcrumbTrail $trail) {
    $trail->parent('ventas.index');
    $trail->push('Notas de Venta', route('ventas.notas-de-venta'));
});

// Home > Dashboard > Ventas > Registro en Caja 
Breadcrumbs::for('ventas.registro-en-caja', function (BreadcrumbTrail $trail) {
    $trail->parent('ventas.index');
    $trail->push('Registro en Caja', route('ventas.registro-en-caja.index'));
});

// Home > Dashboard > Ventas > Facturación 4.0
Breadcrumbs::for('ventas.facturacion-4-0', function (BreadcrumbTrail $trail) {
    $trail->parent('ventas.index');
    $trail->push('Facturación 4.0', route('ventas.facturacion-4-0'));
});

// Home > Dashboard > Ventas > Complementos de Pago
Breadcrumbs::for('ventas.complementos-de-pago', function (BreadcrumbTrail $trail) {
    $trail->parent('ventas.index');
    $trail->push('Complementos de Pago', route('ventas.complementos-de-pago'));
});

