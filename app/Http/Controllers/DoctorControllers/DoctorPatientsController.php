<?php

namespace App\Http\Controllers\DoctorControllers;

use App\Http\Controllers\Controller;
use App\Models\DoctorModels\Doctor;
use App\Models\Drug;
use App\Models\PatientModels\Patient;
use App\Traits\QueryTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Contracts\Providers\Auth;

class DoctorPatientsController extends Controller
{
    use QueryTrait;
    public function __construct()
    {
        $this->middleware('assign.guard:doctor-api');
    }

    public function addPatient(Request $request)
    {
        $patient = Patient::find($request->id);
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
            'userName' => 'required|string|max:55|unique:patients',
            'email' => 'required|string|email',
            'phoneNumber' => 'required',
            'nationalityID' => 'required',
            'gender' => 'required',
            'bloodSymbol' => 'required',
            'birthday' => 'date_format:Y-m-d|before:today',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'result' => null,
                'code' => '404',
            ], 404);
        }
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

        return response()->json([
            'result' => $patient,
            'code' => '200',
        ], 200);
    }

    public function getPatientByID($id){
        $patient = Patient::find($id);
        if($patient){
            return response()->json([
                'result' => $patient,
                'code' => '200',
            ],200);
        }
        else{
            return response()->json([
                'result' => null,
                'msg' => 'The Patient Is Not Found !! ' ,
                'code' => '404',
            ],404);
        }
    }

    public function getFavPatients($id){
        $auth_doctor = auth('doctor-api')->user();
        $doctor = Doctor::find($id);

        $checkNotMatching = $this->checkUserToken($auth_doctor,$doctor);
        if($checkNotMatching){
            return response()->json([
                'result' => null,
                'msg' => 'You Can Not See Another Doctor List !!',
                'code' => '414',
            ]);
        }
        $favPatient = $doctor->favouritePatients()->get();
        return response()->json([
            'result' => $favPatient,
            'code' => '200',
        ], 200);
    }

    public function addFavouritePatients(Request $request){
        DB::table('favourite_patients')
        ->insert(['doctor_id' => $request->doctor_id , 'patient_id' => $request->patient_id ]);
        return response()->json([
            'result' => 'Patient Success Added To Doctor Fav List',
            'code' => '200',
        ],200);
    }
}
