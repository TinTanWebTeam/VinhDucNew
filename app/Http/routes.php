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
    Route::get('getViewTreatmentPackage','AdminController@getViewTreatmentPackage');
    //Post
    Route::post('postViewUser','AdminController@postViewUser');
    Route::post('deleteUser','AdminController@deleteUser');

});

/*
 * User Route
 * */
Route::group(['middleware' => ['auth','user'],'prefix' => 'user'],function (){
    Route::get('dashboard','UserController@dashboard');
});