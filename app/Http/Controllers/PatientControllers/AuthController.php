<?php

namespace App\Http\Controllers\PatientControllers;

use App\Http\Controllers\Controller;
use App\Models\Drug;
use App\Models\PatientModels\Patient;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function PatientSignUp(Request $request)
    {
        $patient = Patient::where('userName', $request->userName)->first();
        if ($patient) {
            return response()->json([
                'result' => null,
                'code' => '414',
            ], 414);
        }
        $validator = Validator::make($request->all(), [
            'fullName' => 'required|string|max:55',
            'fatherName' => 'required|string|max:55',
            'motherName' => 'required|string|max:55',
            'userName' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'email' => 'required|email|max:255',
            'gender' => 'required',
            'birthday' => 'date_format:Y-m-d|before:today',
            'bloodSymbol' => 'required',
            'phoneNumber' => 'required',
            'nationalityID' => 'required',
            // 'work',
            // 'avatarID',
            // 'addressDetails'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'why' => $validator->errors(),
                'result' => null,
                'code' => '404',
            ], 404);
        }
        //return response($request->all());
        $patient = Patient::create([
            'fullName' => $request->fullName,
            'fatherName' => $request->fatherName,
            'motherName' => $request->motherName,
            'userName' => $request->userName,
            'password' => $request->password,
            'email' => $request->email,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'phoneNumber' => $request->phoneNumber,
            'nationalityID' => $request->nationalityID,
            'bloodSymbol' => $request->bloodSymbol,
            'work' => $request->work ?? null,
            'avatarID' => $request->avatarID ?? null,
            'addressDetails' => $request->addressDetails ?? null,
        ]);

        if ($request['permanentDrugs']) {
            $patient->permanentDrugs()->syncWithoutDetaching($request->permanentDrugs);
        }

        if ($request['allergensDrugs']) {
            $patient['allergensDrugs'] = $patient->allergensDrugs()->syncWithoutDetaching($request->allergensDrugs);
        }

        $patient['permanentDrugs'] = Drug::findMany($request->permanentDrugs);
        $patient['allergensDrugs'] = Drug::findMany($request->allergensDrugs);


        $token = JWTAuth::fromUser($patient);
        $patient['token'] = $token;
        return response()->json([
            'result' => $patient,
            'code' => '200',
        ], 200);
    }

    public function PatientSignIn(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'userName' => 'required|string|max:255',
                'password' => 'required|string|min:6'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'result' => $validator->errors()->toJson(),
                    'code' => '404',
                ], 404);
            }

            $credentials = $request->only('userName', 'password');
            //return response($credentials);
            $token = Auth::guard('patient-api')->attempt($credentials);
            //return response($token);

            if (!$token) {
                return response()->json([
                    'result' => 'Invalid Input',
                    'code' => '400',
                ], 400);
            }
            $patient = Auth::guard('patient-api')->user();
            $patient->token = $token;

            return response()->json([
                'result' => $patient,
                'code' => '200',
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'result' => $ex->getMessage(),
                'code' => '404',
            ], $ex->getCode());
        }
    }
}
