<?php


Route::get('/', function () {
    return view('admin.inicio');
})->middleware('auth')->name('inicio');

Auth::routes();

Route::get('/inicio', function () {
    return view('admin.inicio');
})->middleware('auth');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::resource('equipos','EquipoController');
Route::resource('equiposPersonas','EquipoPersonaController');
Route::resource('persona','PersonaController');

Route::resource('impresoras','ImpresoraUbicacionController');
Route::resource('ubicaciones','UbicacionController');
Route::resource('impresoraCartucho','ImpresoraCartuchoController');

Route::resource('impresora','ImpresoraController');
Route::resource('cartucho','CartuchoController');

Route::resource('carpeta','CarpetasController');

Route::get('/reporteToner','ReporteTonerController@export')->name('reporteToner');
Route::get('/reporteEquipos','ReporteEquiposController@export')->name('reporteEquipos');
Route::get('reporteConsumoToner','ReporteTonerController@exportConsumo')->name('reporteConsumoToner');

Route::get('infoCartucho','CartuchoController@infoCartucho')->name('infoCartucho');
Route::get('infoRelacion','CartuchoController@infoRelacion')->name('infoRelacion');
