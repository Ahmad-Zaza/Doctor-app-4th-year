<?php

namespace App\Http\Controllers\DoctorControllers;

use App\Http\Controllers\Controller;
use App\Models\DoctorModels\Doctor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\Models\DoctorModels\Hospital;
use App\Models\DoctorModels\Speciality;
use App\Traits\QueryTrait;
use Illuminate\Foundation\Auth\ResetsPasswords;

class AuthController extends Controller
{
    use QueryTrait;

    public function DoctorSignUp(Request $request)
    {
        $doctor = Doctor::where('username', $request->username)->first();
        if ($doctor) {
            return response()->json([
                'result' => null,
                'code' => '414',
            ], 414);
        }
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6|confirmed',
            'username' => 'required|string|unique:doctors',
        ]);

        if ($validator->fails()) {
            return $this->errorMessage(null , '404' , '');
        }
        //$doctor = Doctor::create($request->all());
        $doctor = Doctor::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'username' => $request->username,
            'avatar' => $request->avatar,
            'speciality_id' => $request->speciality_id ?? null,
            'hospital_id' => $request->hospital_id ?? null,
            'experience' => $request->experience ?? null,
            'picked_appointment' => false
        ]);

        $doctor->speciality_id= $request->speciality_id ?? null;
        $doctor->hospital_id = $request->hospital_id ?? null;


        $doctor['speciality'] = Speciality::find($request->speciality_id);
        $doctor['hospital'] = Hospital::find($request->hospital_id);
        $doctor->Has_Clinics = false;

        $token = JWTAuth::fromUser($doctor);
        $doctor['token'] = $token;
        return $this->successMessage($doctor , '200');
    }



    public function DoctorSignIn(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|max:255',
                'password' => 'required|string|min:6'
            ]);

            if ($validator->fails()) {
                return $this->errorMessage(null , '404' , '');
            }

            $credentials = $request->only('username', 'password');
            $token = Auth::guard('doctor-api')->attempt($credentials);
            //return response()->json($token);
            if (!$token) {
                return response()->json([
                    'result' => 'Invalid Input',
                    'code' => '200',
                ], 400);
            }
            $doctor = Auth::guard('doctor-api')->user();

            $doctor['speciality'] = $doctor->doctorSpeciality($doctor->speciality_id);
            $doctor['hospital'] = $doctor->doctorHospital($doctor->hospital_id);
            $doctor->Has_Clinics = $doctor->CheckDoctorClinics($doctor);
            $doctor->token = $token;

            return $this->successMessage($doctor , '200');
        } catch (Exception $ex) {
            return $this->errorMessage($ex->getMessage() , '404' , '');
        }
    }
}
