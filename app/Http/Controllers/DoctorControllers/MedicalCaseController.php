<?php

namespace App\Http\Controllers\DoctorControllers;

use App\Http\Controllers\Controller;
use App\Models\MedicalCase;
use App\Traits\QueryTrait;
use Faker\Provider\Medical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MedicalCaseController extends Controller
{
    use QueryTrait;
    public function __construct()
    {
        $this->middleware('assign.guard:doctor-api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicalCases = MedicalCase::all();
        if (!$medicalCases) {
            return response()->json([
                'result' => null,
                'msg' => 'No Medical Cases Founded',
                'code' => '404',
            ], 404);
        }
        return response()->json([
            'result' => $this->doPagination(request()->all(),$medicalCases),
            'code' => '200',
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response($request->all());
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required',
            'patient_id' => 'required',
            'clinic_id' => 'required',
            'title' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->errorMessage(null , '404' , $validator->errors());
        }

        $medicalCase = MedicalCase::create($request->all());
        return $this->successMessage($medicalCase , '200');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medicalCase = MedicalCase::find($id);
        if (!$medicalCase) {
            return $this->errorMessage(null , '404' , 'No Medical Cases With This Id !!');
        }
        return $this->successMessage($medicalCase , '200');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $medicalCase = MedicalCase::find($id);

        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required',
            'patient_id' => 'required',
            'clinic_id' => 'required',
            'title' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->errorMessage(null , '404' , $validator->errors());
        }

        $medicalCase->update($request->all());

        return $this->successMessage($medicalCase , '200');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
