l<?php

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

Route::get('/', 'TestController@welcome');




/*Route::get('/precios','PrecioController@index');
Route::post('/searchprecios','PrecioController@show');
Route::get('/precios/json', 'PrecioController@data');
Route::resource('/precios',PrecioController::class);*/

Route::get('/precios','PrecioController@index');
Route::get('/preciosf','PrecioController@indexf');


Route::get('/search', 'SearchController@show');
Route::get('/products/json', 'SearchController@data');

Route::get('/products/{id}', 'ProductController@show');
Route::get('/categories/{category}', 'CategoryController@show');

//Detalle de Pedidos en General
Route::post('/cart', 'CartDetailController@store');	
Route::delete('/cart','CartDetailController@destroy');  //eliminar Pedido
Route::get('/cart/{id}','CartDetailController@edit');



Route::post('/order','CartController@update');		//Cerrar Pedido 
Route::post('/feedback','FeedbackController@update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth','admin'])->prefix('admin')->namespace('Admin')->group(function(){

// Módulo de Cajas
	Route::get('/cajas','CajaController@index');					// Caja Nueva
	Route::get('/cajas/create','CajaController@create');			// Form de alta de Cajas
	Route::post('/cajas','CajaController@store');					// Alta de la Caja
	Route::get('/cajas/{id}/cerrar','CajaController@formcerrar');	// Form de Cierre de Caja
	Route::post('/cajas/cerrar','CajaController@cerrar');			// Cierre de Caja
	Route::post('/cajas/{id}/imprimir','CajaController@imprimir');	// IMprimir Caja Cerrada

	Route::get('/cajascerradas','CajaController@indexcerradas');			// Listado de Cajas Cerradas
	
// Arqueos
	Route::get('/cajas/{id}/arqueo','CajaController@arqueo');	// Form para registro de Arqueo
	Route::post('/cajas/arqueo','CajaController@storearqueo');	// Alta de Arqueo

// Egresos
	Route::get('/cajas/{id}/egreso','CajaController@egreso');				// Listado de Egresos
	Route::get('/cajas/{id}/egresocreate','CajaController@egresocreate');	// Form de Egresos
	Route::post('/cajas/egreso','CajaController@storeegreso');				// Alta de Egreso
	Route::get('/cajas/egreso/{id}/edit','CajaController@editegreso');		// Edición de Egreso
	Route::post('/cajas/egreso/edit','CajaController@egresoupdate');		// Actualización del Egreso
	Route::delete('/cajas/egreso/{id}','CajaController@egresodestroy');		// Eliminación de un Egreso

// Cheques
	Route::get('/cajas/{id}/cheque','CajaController@cheque');				// Listado de cheques
	Route::get('/cajas/{id}/chequecreate','CajaController@chequecreate');	// Form de cheques
	Route::post('/cajas/cheque','CajaController@storecheque');				// Alta de cheque
	Route::get('/cajas/cheque/{id}/edit','CajaController@editcheque');		// Edición de cheque
	Route::post('/cajas/cheque/edit','CajaController@chequeupdate');		// Actualización del cheque
	Route::delete('/cajas/cheque/{id}','CajaController@chequedestroy');		// Eliminación de un cheque

// Tarjetas
	Route::get('/cajas/{id}/tarjeta','CajaController@tarjeta');				// Listado de tarjetas
	Route::get('/cajas/{id}/tarjetacreate','CajaController@tarjetacreate');	// Form de tarjetas
	Route::post('/cajas/tarjeta','CajaController@storetarjeta');				// Alta de tarjeta
	Route::get('/cajas/tarjeta/{id}/edit','CajaController@edittarjeta');		// Edición de tarjeta
	Route::post('/cajas/tarjeta/edit','CajaController@tarjetaupdate');		// Actualización del tarjeta
	Route::delete('/cajas/tarjeta/{id}','CajaController@tarjetadestroy');		// Eliminación de un tarjeta

// Otro MP
	Route::get('/cajas/{id}/otrafp','CajaController@otrafp');				// Listado de otrafps
	Route::get('/cajas/{id}/otrafpcreate','CajaController@otrafpcreate');	// Form de otrafps
	Route::post('/cajas/otrafp','CajaController@storeotrafp');				// Alta de otrafp
	Route::get('/cajas/otrafp/{id}/edit','CajaController@editotrafp');		// Edición de otrafp
	Route::post('/cajas/otrafp/edit','CajaController@otrafpupdate');		// Actualización del otrafp
	Route::delete('/cajas/otrafp/{id}','CajaController@otrafpdestroy');		// Eliminación de un otrafp

// Definicion de los sectores
	Route::get('/sectors','SectorController@index');				//Listado de Sectores
	Route::get('/sectors/create','SectorController@create');		// Form de alta de Secores
	Route::post('/sectors','SectorController@store');				// Alta del Sector
	Route::get('/sectors/{id}/edit','SectorController@edit');		// fmr para Edit
	Route::post('/sectors/{id}/edit','SectorController@update');	// Actualización del Sector
	Route::delete('/sectors/{id}','SectorController@destroy');		// Eliminación de un Sector

// Definicion de los Puntos de Ventas
	Route::get('/puntodeventa','PuntodeventaController@index');				//Listado de PUntodeventaes
	Route::get('/puntodeventa/create','PuntodeventaController@create');		// Form de alta de PUntodeventaes
	Route::post('/puntodeventa','PuntodeventaController@store');				// Alta del PUntodeventa
	Route::get('/puntodeventa/{id}/edit','PuntodeventaController@edit');		// fmr para Edit
	Route::post('/puntodeventa/{id}/edit','PuntodeventaController@update');	// Actualización del PUntodeventa
	Route::delete('/puntodeventa/{id}','PuntodeventaController@destroy');		// Eliminación de un Sector

//Precios protegido
	Route::get('/precios','PrecioController@index');
	Route::get('/preciosf','PrecioController@indexf');

//Productos 
	Route::get('/products','ProductController@index');
	Route::get('/products/create','ProductController@create');
	Route::post('/products','ProductController@store');

	Route::get('/products/{id}/edit','ProductController@edit');
	Route::post('/products/{id}/edit','ProductController@update');

	Route::delete('/products/{id}','ProductController@destroy');

	Route::get('/products/{id}/images','ImageController@index');  	//Listado de Imágenes
	Route::post('/products/{id}/images','ImageController@store');
	Route::delete('/products/{id}/images','ImageController@destroy');	
	Route::get('/products/{id}/images/select/{image}','ImageController@select');

//Promociones
	Route::get('/promotions','PromotionController@index');
	Route::get('/promotions/create','PromotionController@create');
	Route::post('/promotions','PromotionController@store');

	Route::get('/promotions/{id}/edit','PromotionController@edit');
	Route::post('/promotions/{id}/edit','PromotionController@update');

	Route::delete('/promotions/{id}','PromotionController@destroy');
/*
	Route::get('/promotions/{id}/images','PromoImageController@index');  //Listado de Imágenes
	Route::post('/promotions/{id}/images','PromoImageController@store');
	Route::delete('/promotions/{id}/images','PromoImageController@destroy');	
	Route::get('/promotions/{id}/images/select/{image}','PromoImageController@select');
*/
//Categorias

	Route::get('/categories','CategoryController@index');
	Route::get('/categories/create','CategoryController@create');
	Route::post('/categories','CategoryController@store');

	Route::get('/categories/{id}/edit','CategoryController@edit');
	Route::post('/categories/{id}/edit','CategoryController@update');

	Route::delete('/categories/{id}','CategoryController@destroy');

	Route::get('/categories/{id}/images','CategoryImageController@index');  //Listado de Imágenes
	Route::post('/categories/{id}/images','CategoryImageController@store');
	Route::delete('/categories/{id}/images','CategoryImageController@destroy');	
	Route::get('/categories/{id}/images/select/{image}','CategoryImageController@select');


//Clientes
	Route::get('/clients','ClientController@index');				// Listado de clienteas
	Route::get('/clients/create','ClientController@create');		// Form de Alta de clientes
	Route::post('/clients','ClientController@store');				// Rergistro del cliete en la BD

	Route::get('/clients/{id}/edit', 'ClientController@edit');		//Form de Edicion del cliente
	Route::post('/clients/{id}/edit','ClientController@update');  	// Actualización de la bd

	Route::delete('/clients/{id}','ClientController@destroy');  	// eliminar un cliente

//Remitos
	Route::get('/remito/{id}','CartController@vercart');						//Ver Contenido del Remito
	Route::get('/remito/{id}/edit', 'CartController@edit');						//Form de Edicion del Remito
	Route::get('/remito/{id}/facturar', 'CartController@facturarremito');		//Form de Facturacion del 
	Route::get('/remito/edititem/{id}','CartDetailController@editaritem');		//Editar Item del 	Remito
	Route::post('/remito/item', 'CartDetailController@update');					//Actualizar Item
	Route::delete('/remito', 'CartController@destroy');					//eliminar el Pedido

	Route::post('/remito/facturar', 'CartController@update');					//Confirmar Facturar Remito

	Route::get('/remito/{id}/excel', 'CartController@excel');					//Enviar el Rmito a Excel
	Route::get('/remito/{id}/remitopdf', 'CartController@remitopdf');			//Enviar el Rmito a Pdf

//Pagos
	Route::get('/pagos','PaymentController@index');								//Listado de Clientes para Pagos
	Route::get('/pagos/{id}/nuevopago','PaymentController@nuevopago');			//Formulario de Pagos
	Route::post('/pagos','PaymentController@store');							// Rergistro del pago en la BD
});

//Parte Admin
Route::get('/orders/{id}','CartController@vercart');						//Ver Contenido del Remito

Route::middleware(['auth', 'usuario'])->prefix('usuario')->namespace('Admin')->group(function () {
    //Precios protegido
	Route::get('/precios','PrecioController@index');
	Route::get('/remito/{id}','PrecioController@verremito');				//Ver Contenido del Remito
	Route::get('/preciosf','PrecioController@indexf');						
	Route::get('/agregaitemalpedido/{id}', 'PrecioController@agregaitem');
	Route::post('/cart','PrecioController@store');
	Route::delete('/cart','PrecioController@destroy');		//Eliminar un Pedido 
	Route::post('/cart/edit','PrecioController@update');	//Actualizar datos del Item
	Route::get('/editaitemdelpedido/{id}', 'PrecioController@editaitem');	// Editar Item del Pedido

	// Módulo de Cajas
	Route::get('/cajas','CajaController@index');					// Caja Nueva
	Route::get('/cajas/create','CajaController@create');			// Form de alta de Cajas
	Route::post('/cajas','CajaController@store');					// Alta de la Caja
	Route::get('/cajas/{id}/cerrar','CajaController@formcerrar');	// Form de Cierre de Caja
	Route::post('/cajas/cerrar','CajaController@cerrar');			// Cierre de Caja
	Route::post('/cajas/{id}/imprimir','CajaController@imprimir');	// IMprimir Caja Cerrada
	Route::post('/cajas/caja-pdf','CajaController@generatePDF');				//Generar pd de caja

	Route::get('/cajascerradas','CajaController@indexcerradas');			// Listado de Cajas Cerradas

	// Arqueos
	Route::get('/cajas/{id}/arqueo','CajaController@arqueo');	// Form para registro de Arqueo
	Route::post('/cajas/arqueo','CajaController@storearqueo');	// Alta de Arqueo

	// Cheques
	Route::get('/cajas/{id}/cheque','CajaController@cheque');				// Listado de cheques
	Route::get('/cajas/{id}/chequecreate','CajaController@chequecreate');	// Form de cheques
	Route::post('/cajas/cheque','CajaController@storecheque');				// Alta de cheque
	Route::get('/cajas/cheque/{id}/edit','CajaController@editcheque');		// Edición de cheque
	Route::post('/cajas/cheque/edit','CajaController@chequeupdate');		// Actualización del cheque
	Route::delete('/cajas/cheque/{id}','CajaController@chequedestroy');		// Eliminación de un cheque

	// Egresos
	Route::get('/cajas/{id}/egreso','CajaController@egreso');				// Listado de Egresos
	Route::get('/cajas/{id}/egresocreate','CajaController@egresocreate');	// Form de Egresos
	Route::post('/cajas/egreso','CajaController@storeegreso');				// Alta de Egreso
	Route::get('/cajas/egreso/{id}/edit','CajaController@editegreso');		// Edición de Egreso
	Route::post('/cajas/egreso/edit','CajaController@egresoupdate');		// Actualización del Egreso
	Route::delete('/cajas/egreso/{id}','CajaController@egresodestroy');		// Eliminación de un Egreso

	// Tarjetas
	Route::get('/cajas/{id}/tarjeta','CajaController@tarjeta');				// Listado de tarjetas
	Route::get('/cajas/{id}/tarjetacreate','CajaController@tarjetacreate');	// Form de tarjetas
	Route::post('/cajas/tarjeta','CajaController@storetarjeta');				// Alta de tarjeta
	Route::get('/cajas/tarjeta/{id}/edit','CajaController@edittarjeta');		// Edición de tarjeta
	Route::post('/cajas/tarjeta/edit','CajaController@tarjetaupdate');		// Actualización del tarjeta
	Route::delete('/cajas/tarjeta/{id}','CajaController@tarjetadestroy');		// Eliminación de un tarjeta

	// Otro MP
	Route::get('/cajas/{id}/otrafp','CajaController@otrafp');				// Listado de otrafps
	Route::get('/cajas/{id}/otrafpcreate','CajaController@otrafpcreate');	// Form de otrafps
	Route::post('/cajas/otrafp','CajaController@storeotrafp');				// Alta de otrafp
	Route::get('/cajas/otrafp/{id}/edit','CajaController@editotrafp');		// Edición de otrafp
	Route::post('/cajas/otrafp/edit','CajaController@otrafpupdate');		// Actualización del otrafp
	Route::delete('/cajas/otrafp/{id}','CajaController@otrafpdestroy');		// Eliminación de un otrafp


});

Route::get('pdf', 'PdfController@caja');


/*Route::middleware(['auth', 'client'])->namespace('Cliente')->group(function () {
    Route::get('/schedule','ScheduleController@edit');
    Route::post('/schedule','ScheduleController@store');
});*/


