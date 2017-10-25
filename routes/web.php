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

Route::get('/', 'HomeController@index');

Route::get('/home', function(){
	return redirect()->route('home');
});

Route::get('/dashboard', 'DashboardController@index')->name('home');
Route::resource('waivers', 'WaiversController', ['except' => ['destroy']]);
Route::resource('profiles', 'ProfilesController', ['except' => ['destroy']]);
Route::get('/profiles/{id}/confirm', 'ProfilesController@confirm');
Route::resource('membership', 'MembershipController', ['only' => ['index', 'store']]);
// Route::resource('admin/waivertext', 'WaivertextController');
Route::resource('teams', 'TeamsController', ['except' => ['destory', 'create', 'store']]);

Route::get('/manage/team', 'ManageTeamsController@index');
Route::get('/manage/team/{id}', 'ManageTeamsController@show');
// Route::get('/manage/team/{id}/new-req', 'ManageTeamsController@new-req');
// Route::put('/manage/team/{id}/new-req/{user_id}/confirm', 'ManageTeamsController@confirm-req');
Route::get('/manage/team/{id}/roster', 'ManageTeamsController@roster');
Route::get('/manage/team/{id}/edit', 'ManageTeamsController@edit_team');
Route::put('/manage/team/{id}', 'ManageTeamsController@update_team');

Route::get('race/{id}', 'RaceController@show');
// register race
Route::get('race/{id}/register/{team_id}', 'RaceController@register_create');
Route::post('race/{id}/register', 'RaceController@register_store');
// show/edit race registration
Route::get('race_registration/{id}', 'RaceController@register_show');
// Route::get('race_registration/{id}/edit', 'RaceController@register_edit');
// Route::put('race_registration/{id}', 'RaceController@register_update');
// Route::delete('race_registration/{id}', 'RaceController@register_destroy');
// submit/show/edit race manifests
Route::get('race_manifest/{crew_id}/create', 'RaceController@manifest_create');
Route::post('race_manifest/{crew_id}', 'RaceController@manifest_store');
Route::get('race_manifest/{crew_id}/edit', 'RaceController@manifest_edit');
Auth::routes();

