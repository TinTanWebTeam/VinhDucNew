<?php
/*
 * Public Route
 * */
Route::get('/',function(){
   if(Auth::check()){
       if(Auth::user()->roleId == 1)
           return redirect('admin/dashboard');
       return redirect('user/dashboard');
   }
   return redirect('auth/login');
});
Route::get('auth/logout','Auth\AuthController@getLogout');
Route::group(['middleware' => ['guest']],function (){
    Route::get('auth/login','Auth\AuthController@getLogin');
    Route::post('auth/login','Auth\AuthController@postLogin');
});

/*
 * Admin Route
 * */
Route::group(['middleware' => ['auth','admin'],'prefix' => 'admin'],function (){
    //Get
    Route::get('dashboard','AdminController@dashboard');
    Route::get('getViewUser','AdminController@getViewUser');
    Route::get('getViewPosition','AdminController@getViewPosition');
    Route::get('getViewPatient','AdminController@getViewPatient');
    Route::get('getViewTherapist','AdminController@getViewTherapist');
    Route::get('getViewTreatmentPackage','AdminController@getViewTreatmentPackage');
    Route::get('getViewDiagnostic','AdminController@getViewDiagnostic');
    //Post
    Route::post('postViewUser','AdminController@postViewUser');
    Route::post('deleteUser','AdminController@deleteUser');
    Route::post('addNewAndUpdateUser','AdminController@addNewAndUpdateUser');
    Route::post('postViewPosition','AdminController@postViewPosition');
    Route::post('addNewAndUpdatePosition','AdminController@addNewAndUpdatePosition');
    Route::post('postViewTherapist','AdminController@postViewTherapist');
    Route::post('deleteTherapist','AdminController@deleteTherapist');
    Route::post('addNewAndUpdateTherapist','AdminController@addNewAndUpdateTherapist');
    Route::post('postViewPatient','AdminController@postViewPatient');
    Route::post('deletePatient','AdminController@deletePatient');
    Route::post('addNewAndUpdatePatient','AdminController@addNewAndUpdatePatient');
    Route::post('searchPatient','AdminController@searchPatient');
});

/*
 * User Route
 * */
Route::group(['middleware' => ['auth','user'],'prefix' => 'user'],function (){
    Route::get('dashboard','UserController@dashboard');
});