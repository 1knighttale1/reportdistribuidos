<?php

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

Route::get('/', function () {
    return view('index');
});

//parte de persona
Route::get('persona','PersonaController@index')->name('persona.index');
Route::get('persona/nuevo','PersonaController@create')->name('persona.nuevo');
Route::post('persona/guardar','PersonaController@store')->name('persona.guardar');
Route::get('persona/edit/{id}','PersonaController@edit')->name('persona.edit');
Route::post('persona/edit' , 'PersonaController@update')->name('persona.actualizar');
Route::get('persona/eliminar/{id}','PersonaController@destroy');
//parte de administrador
Route::get('administrador' , 'AdministradorController@index')->name('administrador.index');
Route::get('administrador/nuevo/{id}' , 'AdministradorController@create')->name('administrador.nuevo');
Route::get('administrador/edit/{id}' , 'AdministradorController@edit')->name('administrador.edit');
Route::post('administrador/edit' , 'AdministradorController@update')->name('administrador.actualizar');
Route::post('administrador/guardar' , 'AdministradorController@store')->name('administrador.guardar');
Route::get('administrador/eliminar/{id}' , 'AdministradorController@destroy');
//parte de arbitro
Route::get('arbitro' , 'ArbitroController@index') -> name('arbitro.index');
Route::get('arbitro/nuevo/{id}','ArbitroController@create') ->name('arbitro.nuevo');
Route::get('arbitro/edit/{id}' , 'ArbitroController@edit')->name('arbitro.edit');
Route::post('arbitro/guardar' , 'ArbitroController@store') -> name('arbitro.guardar');
Route::get('arbitro/eliminar/{id}' , 'ArbitroController@destroy') ;

//fixture
Route::get('/fixture','FixtureController@index')->name('fixture.index');
Route::get('/fixture/edit/{id}','FixtureController@edit')->name('fixture.edit');
Route::post('/fixture/actualizar','FixtureController@update')->name('fixture.actualizar');
Route::get('/fixture/nuevo','FixtureController@create')->name('fixture.nuevo');
Route::post('/fixture/guardar','FixtureController@store')->name('fixture.guardar');
Route::get('/fixture/eliminar/{id}','FixtureController@destroy')->name('fixture.eliminar');
Route::get('/fixture/rol/{id}','FixtureController@rol')->name('fixture.rol');
Route::get('/fixture/resultados/{id}','FixtureController@resultados')->name('fixture.resultados');

Route::get('/grupo/{id}','GrupoController@index')->name('grupo.index');
Route::get('/grupo/edit/{id}','GrupoController@edit')->name('grupo.edit');
Route::post('/grupo/actualizar','GrupoController@update')->name('grupo.actualizar');
Route::post('/grupo/eliminar','GrupoController@destroy')->name('grupo.eliminar');

Route::get('/actividad/{id}','ActividadController@index')->name('actividad.index');
Route::get('/actividad/edit/{id}','ActividadController@edit')->name('actividad.edit');
Route::post('/actividad/actualizar','ActividadController@update')->name('actividad.actualizar');
Route::post('/actividad/eliminar','ActividadController@destroy')->name('actividad.eliminar');

Route::get('/partido/{id}','PartidoController@index')->name('partido.index');
Route::get('/partido/edit/{id}','PartidoController@edit')->name('partido.edit');
Route::post('/partido/actualizar','PartidoController@update')->name('partido.actualizar');
Route::post('/partido/eliminar','PartidoController@destroy')->name('partido.eliminar');
Route::get('/partido/partidos_arbitro/{id}','PartidoController@partidos_arbitro')->name('partido.partidos_arbitro');
Route::get('/partido/resultado/{id}','PartidoController@resultados')->name('partido.resultados');
Route::post('/partido/guardar_resultado','PartidoController@guardar_resultado')->name('partido.guardar_resultado');


Route::get('delegado','DelegadoController@index')->name('delegado.index');
Route::get('delegado/nuevo','DelegadoController@create')->name('delegado.create');

Route::post('delegado/guardar','DelegadoController@store')->name('delegado.guardar');

Route::get('delegado/editar/{id}','DelegadoController@edit')->name('delegado.editar');
Route::post('delegado/editar','DelegadoController@update')->name('delegado.actualizar');

Route::get('delegado/eliminar/{id}','DelegadoController@destroy')->name('delegado.eliminar');

Route::get('equipo','EquipoController@index')->name('equipo.index');

Route::get('equipo/nuevo','EquipoController@create')->name('equipo.crear');
Route::post('equipo/guardar','EquipoController@store')->name('equipo.guardar');

Route::get('equipo/editar/{id}','EquipoController@edit')->name('equipo.editar');
Route::post('equipo/actualizar','EquipoController@update')->name('equipo.actualizar');

Route::get('equipo/eliminar/{id}','EquipoController@destroy')->name('equipo.eliminar');

Route::get('jugador','JugadorController@index')->name('jugador.index');

Route::get('jugador/equipo','JugadorController@equipo')->name('jugador.equipo');

Route::get('jugador/nuevo','JugadorController@create')->name('jugador.crear');
Route::post('jugador/guardar','JugadorController@store')->name('jugador.guardar');

Route::get('jugador/editar/{id}','JugadorController@edit')->name('jugador.editar');
Route::post('jugador/actualizar','JugadorController@update')->name('jugador.actualizar');

Route::get('jugador/eliminar/{id}','JugadorController@destroy')->name('jugador.eliminar');

