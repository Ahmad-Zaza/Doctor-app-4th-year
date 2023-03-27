<?php

namespace App\Http\Controllers\DoctorControllers;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\DoctorModels\Doctor;
use App\Models\MedicalCase;
use App\Traits\QueryTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConsultationController extends Controller
{
    use QueryTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all() ,[
            'speciality' => 'required',
            'medical_case_id' => 'required',
            'date' => 'required|string',
            'content' => 'required|string',
        ]);

        if($validator->fails()){
            return $this->errorMessage(null, '404', '');
        }

        $consultation = Consultation::create([
            'speciality' => $request->speciality,
            'medical_case_id' => $request->medical_case_id,
            'content' => $request->content,
            'date' => $request->date,
        ]);

        if ($request['doctors']) {
            $consultation->doctors()->syncWithoutDetaching($request->doctors);
        }

        $consultation['medical_case'] = MedicalCase::find($request->medical_case_id);
        $consultation['doctors'] = Doctor::findMany($request->doctors);

        return $this->successMessage($consultation , '200');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $consultation = Consultation::find($id);
        if($consultation){
            return $this->successMessage($consultation , '200');
        }
        else{
            return $this->errorMessage(null , '404' , '');
        }
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
        $consultation = Consultation::find($id);

        $validator = Validator::make($request->all() ,[
            'speciality' => 'required',
            'medical_case_id' => 'required',
            'date' => 'required|string',
            'content' => 'required|string',
        ]);

        if($validator->fails()){
            return $this->errorMessage(null, '404', '');
        }

        $consultation->update([
            'speciality' => $request->speciality,
            'medical_case_id' => $request->medical_case_id,
            'content' => $request->content,
            'date' => $request->date,
        ]);

        if ($request['doctors']) {
            $consultation->doctors()->syncWithoutDetaching($request->doctors);
        }

        $consultation['medical_case'] = MedicalCase::find($request->medical_case_id);
        $consultation['doctors'] = Doctor::findMany($request->doctors);

        return $this->successMessage($consultation , '200');





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

    public function getConsultationMedicalCase($id){
        $consultation = Consultation::find($id);
        //return response($consultation);
        $medicalCase = $consultation->medicalCase()->get();
        return $this->successMessage($medicalCase, '200');
    }
}
