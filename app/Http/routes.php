<?php
/*
 * Public Route
 * */
Route::get('/',function(){
   if(Auth::check()){
        return redirect('admin/dashboard');
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
Route::group(['middleware' => ['auth'],'prefix' => 'admin'],function (){
    //Get
    Route::get('dashboard','AdminController@dashboard');
    Route::get('getViewUser','AdminController@getViewUser');
    Route::get('getViewPosition','AdminController@getViewPosition');
    Route::get('getViewPatient','AdminController@getViewPatient');
    Route::get('getViewTherapist','AdminController@getViewTherapist');
    Route::get('getViewTreatmentPackage','AdminController@getViewTreatmentPackage');
    Route::get('getViewDiagnostic','AdminController@getViewDiagnostic');
    Route::get('getViewDiagnostic1','AdminController@getViewDiagnostic1');
    Route::get('getSurveyProgression','AdminController@getSurveyProgression');
    Route::get('getRegimens','AdminController@getRegimens');
    Route::get('getViewProfessional','AdminController@getViewProfessional');
    Route::get('getStatisticsPatients','AdminController@getStatisticsPatients');
    Route::get('getStatisticsTherapist','AdminController@getStatisticsTherapist');
    Route::get('getdate','AdminController@getdate');
    Route::get('getViewMedicalRecord','AdminController@getViewMedicalRecord');
    Route::get('getViewDoctor','AdminController@getViewDoctor');
    Route::get('getSearchCodeDoctor','AdminController@getSearchCodeDoctor');
    Route::get('getSearchCodeTherapist','AdminController@getSearchCodeTherapist');
    Route::get('getSearchCodeProfessional','AdminController@getSearchCodeProfessional');
    Route::get('getViewSourceCustomer','AdminController@getViewSourceCustomer');
    Route::get('getSearchCodePatient','AdminController@getSearchCodePatient');
    Route::get('gettingSick','AdminController@gettingSick');

    // Route::get('getSearchCodeProfessional','AdminController@getSearchCodeProfessional');
    //Anh TamgettingSick

    Route::get('getViewPackage','AdminController@getViewPackage');
    Route::get('SurveyProgression','AdminController@SurveyProgression');
    Route::get('getViewProTreatment','AdminController@getViewProTreatment');
    Route::get('getViewDetailPatient','AdminController@getViewDetailPatient');
    Route::get('getViewLocation','AdminController@getViewLocation');
    Route::get('getViewProvinces','AdminController@getViewProvinces');
    Route::get('getViewAge','AdminController@getViewAge');
    Route::get('getViewSearch','AdminController@getViewSearch');
    Route::get('getViewInformationSurveys','AdminController@getViewInformationSurveys');
    Route::get('getViewStatistics','AdminController@getViewStatistics');
    //Post------------------------------------------
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
    Route::post('SearchTreatmentPackages','AdminController@SearchTreatmentPackages');
    Route::post('searchProfessional','AdminController@searchProfessional');
    Route::post('updateUmpteenthTreatmentPackages','AdminController@updateUmpteenthTreatmentPackages');
    Route::post('addNewTreatment','AdminController@addNewTreatment');
    Route::post('deleteTreatmentPackage','AdminController@deleteTreatmentPackage');
    Route::post('checkAilOrNotAil','AdminController@checkAilOrNotAil');
    Route::post('updateAil','AdminController@updateAil');
    Route::post('updateNotAil','AdminController@updateNotAil');
    Route::post('searchRegimens','AdminController@searchRegimens');
    Route::post('fillToTbody','AdminController@fillToTbody');
    Route::post('SearchTreatmentRegimens','AdminController@SearchTreatmentRegimens');
    Route::post('tbodyRegimen','AdminController@tbodyRegimen');
    Route::post('updateRegimen','AdminController@updateRegimen');
    Route::post('searchStatusPatient','AdminController@searchStatusPatient');
    Route::post('searchProfessionalTherapist','AdminController@searchProfessionalTherapist');
    Route::post('deleteProfessional','AdminController@deleteProfessional');
    Route::post('addNewAndUpdateMedicalRecord','AdminController@addNewAndUpdateMedicalRecord');
    Route::post('getMedicalRecord','AdminController@getMedicalRecord');
    Route::post('getMedicalRecordOnly','AdminController@getMedicalRecordOnly');
    Route::post('searchMedicalRecordViewByCodePatient','AdminController@searchMedicalRecordViewByCodePatient');
    Route::post('addNewAndUpdateDoctor','AdminController@addNewAndUpdateDoctor');
    Route::post('postViewDoctor','AdminController@postViewDoctor');
    Route::post('addNewAndUpdateSourceCustomer','AdminController@addNewAndUpdateSourceCustomer');
    Route::post('postViewSourceCustomer','AdminController@postViewSourceCustomer');
    Route::post('report','AdminController@report');
    Route::post('searchTherapist','AdminController@searchTherapist');
    Route::post('loadDetailByDoctor','AdminController@loadDetailByDoctor');
    Route::post('loadDateCreateProfessional','AdminController@loadDateCreateProfessional');
    Route::post('updatePackageForTreatmentPackage','AdminController@updatePackageForTreatmentPackage');
    Route::post('updateuser','AdminController@updateuser');
    Route::post('searchPatientByCodePatient','AdminController@searchPatientByCodePatient');

    //AnhTam
    Route::post('deleteTreatmentPackage','AdminController@deleteTreatmentPackage');
    Route::post('addNewAndUpdatePackage','AdminController@addNewAndUpdatePackage');
    Route::post('deletePackage','AdminController@deletePackage');
    Route::post('postViewPackage','AdminController@postViewPackage');
    Route::post('postViewTmPackage','AdminController@postViewTmPackage');
    Route::post('deleteTmPackage','AdminController@deleteTmPackage');
    Route::post('addNewAndUpdateTmPackage','AdminController@addNewAndUpdateTmPackage');
    Route::post('postViewProTm','AdminController@postViewProTm');
    Route::post('deleteProTreatment','AdminController@deleteProTreatment');
    Route::post('addNewAndUpdateProTreatment','AdminController@addNewAndUpdateProTreatment');
    Route::post('postViewLocation','AdminController@postViewLocation');
    Route::post('deleteLocation','AdminController@deleteLocation');
    Route::post('addNewAndUpdateLocation','AdminController@addNewAndUpdateLocation');
    Route::post('postViewProvince','AdminController@postViewProvince');
    Route::post('deleteProvince','AdminController@deleteProvince');
    Route::post('addNewAndUpdateProvince','AdminController@addNewAndUpdateProvince');
    Route::post('addNewAndUpdateAge','AdminController@addNewAndUpdateAge');
    Route::post('deleteAge','AdminController@deleteAge');
    Route::post('postViewAge','AdminController@postViewAge');
    Route::post('searchPatientTest','AdminController@searchPatientTest');
    Route::post('postViewInformation','AdminController@postViewInformation');
    Route::post('deleteInformation','AdminController@deleteInformation');
    Route::post('addNewAndUpdateInformation','AdminController@addNewAndUpdateInformation');
    Route::post('searchStatistical','AdminController@searchStatistical');

});