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
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::auth();
// Place all your web routes here...
Route::any('/','HomePageController@index');

//HomeController
Route::post('home/contact','HomePageController@postContact');

//UserController
//Route::get('user/login','UserController@getLogin');
Route::post('user/login','UserController@postLogin');
Route::post('user/register','UserController@postRegister');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

//Route::group(['middleware' => ['auth','permission']], function() {
Route::group(['middleware' => ['auth','web']], function() {

    //User Access - Activities
    Route::any('user/access/activities','ActivityController@getActivities');
    Route::any('user/access/ajaxactivities','ActivityController@getAjaxActivities');
    Route::any('user/access/ajaxactivitieslistitems','ActivityController@getAjaxActivitiesListItems');
    Route::any('user/access/ajaxnotifylistitems','ActivityController@getNotifyActivities');
    Route::any('user/access/clearajaxnotifylistitems','ActivityController@viewAllNotifyActivities');

    //User Access - Users
    Route::any('user/access/users/new','UserController@createNewUser');
    Route::any('user/access/users','UserController@getUsers');
    Route::any('user/access/clients','UserController@getClients');
    Route::any('user/access/users/remove/{id}','UserController@removeUser');
    Route::any('user/access/users/view/{id}','UserController@viewUser');
    Route::any('user/access/users/new/save','UserController@saveUser');
    Route::any('user/access/users/countonline','UserController@getActiveUserCount');

    //User Access - Roles
    Route::any('user/access/roles/new','RoleController@createNewRole');
    Route::any('user/access/roles','RoleController@getRoles');
    Route::any('user/access/roles/remove/{id}','RoleController@removeRole');
    Route::any('user/access/roles/view/{id}','RoleController@viewRole');
    Route::any('user/access/roles/new/save','RoleController@saveRole');

    //Profile
    Route::any('user/dashboard','UserController@getDashboard');
    Route::any('user/profile','UserController@getProfile');
    Route::any('user/profile/settings','UserController@getSettings');
    Route::any('user/profile/settings/save','UserController@saveSettings');
    Route::any('user/profile/currentpassword','UserController@isValidCurrentPassword');

    //admin cms routes
    Route::any('user/profile/cms/pages/new','CMSController@createNewPage');
    Route::any('user/profile/cms/pages','CMSController@getPages');
    Route::any('user/profile/cms/pages/view/{id}','CMSController@viewPage');
    Route::any('user/profile/cms/pages/remove/{id}','CMSController@removePage');
    Route::any('user/profile/cms','CMSController@getPages');
    Route::post('user/profile/cms/pages/new/save','CMSController@savePage');

    //CMS Email Templates
    Route::any('email/templates/new','EmailTemplatesController@createNewEmailTemplate');
    Route::any('email/templates','EmailTemplatesController@getEmailTemplates');
    Route::any('email/templates/view/{id}','EmailTemplatesController@viewEmailTemplate');
    Route::any('email/templates/remove/{id}','EmailTemplatesController@removeEmailTemplate');
    Route::post('email/templates/new/save','EmailTemplatesController@saveEmailTemplate');

    //System
    Route::any('settings/configurations/save','SettingsController@saveConfigurations');
    Route::any('settings/configurations','SettingsController@getConfigurations');
    Route::any('settings/emailconfigurations','SettingsController@getEmailConfigurations');

});