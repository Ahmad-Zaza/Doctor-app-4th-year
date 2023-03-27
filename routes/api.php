<?php

use App\Http\Controllers\ClinicController;
use App\Http\Controllers\DoctorControllers\AuthController;
use App\Http\Controllers\DoctorControllers\ConsultationController;
use App\Http\Controllers\DoctorControllers\DoctorPatientsController;
use App\Http\Controllers\DoctorControllers\HospitalController;
use App\Http\Controllers\DoctorControllers\SpecialityController;
use App\Http\Controllers\DoctorControllers\DoctorProfileController;
use App\Http\Controllers\DoctorControllers\MedicalCaseController;
use App\Http\Controllers\DoctorControllers\PrescriptionController;
use App\Http\Controllers\PatientControllers\PatientController;
use App\Http\Controllers\DoctorProfeleController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PatientControllers\AuthController as PatientControllersAuthController;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'doctor'], function () {
    Route::POST('/signup', [AuthController::class, 'DoctorSignUp']);
    Route::POST('/signin', [AuthController::class, 'DoctorSignIn']);
    Route::apiResource('/clinic', ClinicController::class);
    Route::GET('/clinics/{doctor_id}', [ClinicController::class, 'GetDocotrCilnics']);
    Route::GET('/adresses', [ClinicController::class, 'getAdresses']);
    Route::GET('/areas/{address_id}', [ClinicController::class, 'getAreas']);
    Route::apiResource('/specialities', SpecialityController::class);
    Route::apiResource('/hospitals', HospitalController::class);
    Route::apiResource('/profile', DoctorProfileController::class);
    Route::POST('/addPatient', [DoctorPatientsController::class, 'addPatient']);
    Route::Post('/addToFavourite/{id}', [DoctorPatientsController::class, 'addFavouritePatients']);
    Route::GET('/getFavPatients/{id}', [DoctorPatientsController::class, 'getFavPatients']);
    Route::post('/reset-password-request', [PasswordResetController::class, 'sendPasswordResetEmail']);
    //Route::post('/change-password', [PasswordResetController::class, 'passwordResetProcess']);
    Route::GET('/getPatient-ByID/{id}', [DoctorPatientsController::class, 'getPatientByID']);
    Route::apiResource('/medical-case', MedicalCaseController::class);
    Route::apiResource('/prescription', PrescriptionController::class);
    Route::apiResource('/consultation', ConsultationController::class);
    Route::GET('/getConsultationMedicalCase/{id}' , [ConsultationController::class , 'getConsultationMedicalCase']);
    //    Route::GET('GetAllHospitals', [HospitalController::class, 'index']);

});

Route::group(['prefix' => 'patient'], function () {
    Route::POST('/signup', [PatientControllersAuthController::class, 'PatientSignUp']);
    Route::POST('/signin', [PatientControllersAuthController::class, 'PatientSignIn']);
    Route::GET('/getPatientPermanent/{id}', [PatientController::class, 'getPermanent']);
    Route::GET('/getPatientAllergens/{id}', [PatientController::class, 'getAlergens']);
    Route::GET('/getFavDoctors/{id}', [PatientController::class, 'getFavDoctors']);
});
