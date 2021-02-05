<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MessageClient;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\Messagefactura;
use App\Http\Controllers\FactDetalleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Route::view('/cliente','cliente')->name('cliente');

//Route::view('/factura','factura')->name('factura');

Auth::routes();

//Route::view('/','home')->name('home');


Route::get('/', function () {
        return view('auth.login');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function ()
{
        Route::get('/home/cliente',[ClienteController::class, 'index'])->name('cliente.index');
        Route::get('/home/cliente/insertar',[ClienteController::class, 'insertar'])->name('cliente.insertar');
        Route::get('/home/cliente/{Idcliente}',[ClienteController::class, 'show'])->name('cliente.show');
        Route::get('/home/cliente/{Idcliente}/edit',[ClienteController::class, 'edit'])->name('cliente.edit');

        Route::post('/home/cliente',[MessageClient::class, 'store'])->name('cliente.store');//Messageclient se encargara de la gestion de clientes
        Route::post('/home/cliente/{Idcliente}/edit',[MessageClient::class, 'update'])->name('cliente.update');

        Route::get('/home/factura',[FacturaController::class, 'index'])->name('factura.index');
        Route::get('/home/factura/insertar',[FacturaController::class, 'insertar'])->name('factura.insertar');

        Route::get('/home/factura/insertar/{id}/index',[FactDetalleController::class, 'index'])->name('factura.vistafactura');
        Route::get('/home/factura/insertar/{id}/articulo', [SearchController::class, 'articulo'])->name('search.articulo');
        Route::get('/home/factura/insertar/{id}/variante',[FactDetalleController::class, 'gettalla']);
        Route::get('/home/factura/insertar/{id}/colores',[FactDetalleController::class, 'getcolor']);
        //Route::get('/home/factura/insertar/{id}/precio',[FactDetalleController::class, 'getprecio']);
        Route::get('/home/factura/insertar/{id}/tipo',[FactDetalleController::class, 'gettipo']);
        Route::get('/home/factura/insertar/{id}/stock',[FactDetalleController::class, 'getstock']);
        Route::get('/home/factura/insertar/{id}/index/facturar',[FactDetalleController::class, 'facturador'])->name('factura.facturar');
        Route::get('/home/factura/insertar/{id}/index/facturar/descargar',[FactDetalleController::class, 'descargar'])->name('factura.descargar');

        Route::post('/home/factura/insertar',[Messagefactura::class, 'store'])->name('factura.store');

        Route::post('/home/factura/insertar/{id}/index',[FactDetalleController::class, 'store'])->name('factura.agregar');

});









