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

Auth::routes();

Route::get('/', 'DashboardController@index')->name('dashboard.index');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
Route::get('/charts', 'ChartsController@index')->name('charts.index');
Route::get('/widgets', 'WidgetsController@index')->name('widgets.index');
Route::get('/tables', 'TablesController@index')->name('tables.index');
Route::get('/grid', 'GridController@index')->name('grid.index');
Route::get('/form-common', 'FormsController@common')->name('forms.common');

Route::post('/form-common/createPlaniAnio', 'FormsController@createPlaniAnio')->name('forms.createPlaniAnio');

Route::get('/planifications', 'FormsController@planifications')->name('forms.planifications');
Route::get('/planificationsFilter', 'FormsController@planificationsFilter')->name('forms.planificationsFilter');
Route::post('/eliminarInstanciaPlaniAnio', 'FormsController@eliminarInstanciaPlaniAnio')->name('forms.eliminarInstanciaPlaniAnio');

//Route::get('/form-common-createInstanciaPlaniAño', 'FormsController@createInstanciaPlaniAño')->name('forms.createInstanciaPlaniAño');
//Route::get('/form-planification', 'PlanificationController@index')->name('forms.index');

Route::post('/form-validation/createPlaniUnidad', 'FormsController@createPlaniUnidad')->name('forms.createPlaniUnidad');

Route::get('/form-validation', 'FormsController@validation')->name('forms.validation');

Route::get('/planification', 'PlanificationsController@index')->name('planifications.unidades');
Route::get('/contents', 'PlanificationsController@contents')->name('planifications.contents');
Route::get('/abilities', 'PlanificationsController@abilities')->name('planifications.abilities');
Route::post('/abilities/createAbilities', 'PlanificationsController@createAbilities')->name('planifications.createAbilities');
Route::post('/abilities/eliminarInstanciaUnidadHabilidad', 'PlanificationsController@eliminarInstanciaUnidadHabilidad')->name('planifications.eliminarInstanciaUnidadHabilidad');

Route::get('/objectives', 'PlanificationsController@objectives')->name('planifications.objectives');
Route::post('/abilities/createObjectives', 'PlanificationsController@createObjectives')->name('planifications.createObjectives');

Route::get('/attitudes', 'PlanificationsController@attitudes')->name('planifications.attitudes');
Route::post('/attitudes/createAttitudes', 'PlanificationsController@createAttitudes')->name('planifications.createAttitudes');
Route::post('/attitudes/eliminarInstanciaUnidadActitud', 'PlanificationsController@eliminarInstanciaUnidadActitud')->name('planifications.eliminarInstanciaUnidadActitud');

Route::get('/users', 'AdministradorController@users')->name('admin.users');
Route::post('/guardarCambios', 'AdministradorController@guardarCambios')->name('admin.guardarCambios');

Route::get('/establecimientos', 'AdministradorController@establecimientos')->name('admin.establecimientos');
Route::post('/establecimientos/createInstanciaEstablecimiento', 'AdministradorController@createInstanciaEstablecimiento')->name('admin.createInstanciaEstablecimiento');

Route::get('/establecimientosAlumno', 'AdministradorController@establecimientosAlumno')->name('admin.establecimientosAlumno');
Route::post('/establecimientosAlumno/createInstanciaEstablecimientoAlumno', 'AdministradorController@createInstanciaEstablecimientoAlumno')->name('admin.createInstanciaEstablecimientoAlumno');

Route::get('/solicitar', 'DirectivoController@solicitar')->name('directivo.solicitar');
Route::post('/solicitarCorreccion', 'DirectivoController@solicitarCorreccion')->name('directivo.solicitarCorreccion');

Route::get('/revision', 'DirectivoController@revision')->name('directivo.revision');
Route::get('/revisionDirectivo', 'DirectivoController@revisionDirectivo')->name('directivo.revisionDirectivo');

Route::post('/solicitarRevision', 'DirectivoController@solicitarRevision')->name('directivo.solicitarRevision');

Route::get('/directivo', 'DirectivoController@index')->name('directivo.index');


Route::get('/clases', 'AlumnoController@clases')->name('alumno.clases');
Route::post('/retroalimentar', 'AlumnoController@retroalimentar')->name('alumno.retroalimentar');

Route::get('/retroalimentaciones', 'AlumnoController@retroalimentaciones')->name('alumno.retroalimentaciones');

Route::get('/alumno', 'AlumnoController@index')->name('alumno.index');
Route::get('/planificationAlumno', 'AlumnoController@planificationAlumno')->name('alumno.planificationAlumno');
Route::post('/planificationAlumno/createAsignacionAlumnoCurso', 'AlumnoController@createAsignacionAlumnoCurso')->name('alumno.createAsignacionAlumnoCurso');



Route::get('/form-wizard', 'FormsController@wizard')->name('forms.wizard');
Route::get('/buttons', 'ButtonsController@index')->name('buttons.index');
Route::get('/interface', 'InterfaceController@index')->name('interface.index');
Route::get('/addons-index2', 'AddonsController@index2')->name('addons.index2');
Route::get('/addons-gallery', 'AddonsController@gallery')->name('addons.gallery');
Route::get('/addons-calendar', 'AddonsController@calendar')->name('addons.calendar');

Route::get('/calendarUnidad', 'AddonsController@calendarUnidad')->name('addons.calendarUnidad');
Route::post('/createClase', 'AddonsController@createClase')->name('addons.createClase');
Route::post('/updateClase', 'AddonsController@updateClase')->name('addons.updateClase');
Route::post('/updateClaseTime', 'AddonsController@updateClaseTime')->name('addons.updateClaseTime');
Route::post('/updateClaseDetail', 'AddonsController@updateClaseDetail')->name('addons.updateClaseDetail');
Route::post('/deleteClase', 'AddonsController@deleteClase')->name('addons.deleteClase');

Route::get('/addons-invoice', 'AddonsController@invoice')->name('addons.invoice');
Route::get('/addons-chat', 'AddonsController@chat')->name('addons.chat');
Route::get('/error-403', 'ErrorsController@error403')->name('errors.error403');
Route::get('/error-404', 'ErrorsController@error404')->name('errors.error404');
Route::get('/error-405', 'ErrorsController@error405')->name('errors.error405');
Route::get('/error-500', 'ErrorsController@error500')->name('errors.error500');
Route::get('/error-privilegio', 'ErrorsController@privilegios')->name('errors.privilegios');

Route::get('/logout', 'LogoutController@index')->name('logout');


//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});