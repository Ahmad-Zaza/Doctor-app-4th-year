<?php

namespace App\Http\Controllers\PatientControllers;

use App\Http\Controllers\Controller;
use App\Models\DoctorModels\Doctor;
use App\Models\PatientModels\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Comment\Doc;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('assign.guard:patient-api');
    }

    public function store(Request $request){

    }

    public function getPermanent($id)
    {
        // using query builder (faster)
        $time_start = microtime(true);  // test the time of the query

        // $per = DB::table('drugs')
        //     ->join('drug_permanents', 'drugs.id', '=', 'drug_permanents.drug_id')
        //     ->join('patients', 'patients.id', '=', 'drug_permanents.patient_id')
        //     ->select('drugs.id', 'drugs.name', 'drugs.price', 'drugs.company', 'drugs.scientificName')
        //     ->get();

        // $time = microtime(true) - $time_start;
        // return response()->json([
        //     'permanent' => $per,
        //     'code' => '200',
        //     'Excute time' => $time,
        // ], 200);




        $patient = Patient::find($id);
        $permanent = $patient->permanentDrugs()->get();

        $time = microtime(true) - $time_start;
        return response()->json([
            'permanent' => $permanent,
            'code' => '200',
            'Excute time' => $time,
        ], 200);
    }

    public function getAlergens($id)
    {
        $patient = Patient::find($id);
        $allergens = $patient->allergensDrugs()->get();
        return response()->json([
            'allergens' => $allergens,
            'code' => '200',
        ], 200);
    }

    public function getFavDoctors($id)
    {
        $patient = Patient::find($id);
        $favDoctors = $patient->favouriteDoctors()->get();
        return response()->json([
            'Favourites Doctors ' => $favDoctors,
            'code' => '200',
        ], 200);
    }
}
