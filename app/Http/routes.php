<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    if (Auth::check())
        return redirect('/dashboard');
    else
        return view('welcome');
});


Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');

Route::post('/upload', 'FileController@addFile');
Route::post('/file/upload/achievement', 'AchievementController@addAchievement');

Route::post('/award/delReq/{id}', 'AchievementController@delReqAchievement');

Route::get('/dashboard', 'DashboardController@index');
Route::get('/dashboard/awards', 'DashboardController@viewAchievements');
Route::get('/dashboard/tags/{tag}', 'DashboardController@viewTag');
Route::get('/dashboard/myfiles/', 'DashboardController@myFiles');
Route::get('/dashboard/shared/', 'DashboardController@shared');
Route::get('/dashboard/dept/', 'DashboardController@dept');
Route::get('/dashboard/org/', 'DashboardController@org');
Route::get('/dashboard/deptAwards', 'DepartmentHeadController@deptAwards');
Route::post('/tag/search', "DashboardController@search");

Route::post('/user/addTag', 'UserController@addTag');

Route::get('/modal/addTag/{id}', 'ModalController@addTagModal');
Route::get('/modal/sharing/{id}', 'ModalController@sharing');

Route::get('/file/details/{id}', 'FileController@getDetails');
Route::post('/file/update/{id}', 'FileController@updateFile');
Route::post('/file/sharing/{id}', 'FileController@shareFile');
Route::post('/file/del/{id}', 'FileController@deleteFile');
Route::post('/file/del/{id}/{ver}', 'FileController@deleteFileVer');
Route::post('/file/addTag/{id}', 'FileController@tagFile');
Route::get('/file/setPublic/{id}/{ver}', 'FileController@setPublic');
Route::get('/file/{id}', 'FileController@downloadFile');
Route::get('/file/{id}/{ver}', 'FileController@downloadFileVer');

Route::get('/sidebar/version/{id}', 'RightSideBarController@getVersions');
Route::get('/sidebar/details/{id}', 'RightSideBarController@getDetails');
Route::get('/sidebar/sharing/{id}', 'RightSideBarController@getSharing');
Route::get('/sidebar/tags/{id}', 'RightSideBarController@getTags');
Route::get('/sidebar/delReq/{id}', 'RightSideBarController@getDelReq');

Route::get('/admin', 'AdminController@index');
Route::get('/admin/depts', 'AdminController@depts');
Route::get('/admin/users', 'AdminController@users');
Route::get('/admin/edit/user/{id}', 'AdminController@editUser');
Route::post('/admin/edit/user/{id}', 'AdminController@commitEditUser');
Route::get('/admin/edit/dept/{id}', 'AdminController@editdept');
Route::post('/admin/edit/dept/{id}', 'AdminController@commitEditDept');
Route::get('/admin/user/lock/{id}', 'AdminController@lockUser');
Route::get('/admin/delete', 'AdminController@delAwards');
Route::post('/admin/add/dept', 'AdminController@addDepts');
Route::post('/admin/add/user', 'AdminController@addUser');
Route::get('/admin/del/dept/{id}', 'AdminController@delDepts');
Route::get('/admin/delreq/approve/{id}', 'AdminController@appDelReq');
Route::get('/admin/delreq/deny/{id}', 'AdminController@denDelReq');

Route::get('/hr/verify', 'DashboardController@getUnverified');
Route::get('/hr/approve/{id}', 'AchievementController@approve');
Route::get('/hr/decline/{id}', 'AchievementController@decline');
Route::get('/hr/awards', "AchievementController@getAll");

