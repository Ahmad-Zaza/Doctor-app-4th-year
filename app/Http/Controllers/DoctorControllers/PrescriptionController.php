<?php

namespace App\Http\Controllers\DoctorControllers;

use App\Http\Controllers\Controller;
use App\Models\Drug;
use App\Models\Duration;
use App\Models\kind;
use App\Models\MedicalCase;
use App\Models\Prescription;
use App\Models\Repetation;
use App\Traits\QueryTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrescriptionController extends Controller
{
    use QueryTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
    /*
    $table->integer('medical_case_id');
            $table->integer('drug_id');
            $table->integer('alternative_drug_id');
            $table->integer('repetation_id');
            $table->integer('duration_id');
            $table->longText('note');
            $table->string('quantity');
            $table->integer('kind_id');
    */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'drug_id' => 'required',
            'medical_case_id' => 'required',
            'repetation_id' => 'required',
            'duration_id' => 'required',
            'note' => 'required|string',
        ]);

        if($validator->fails()){
            return $this->errorMessage(null , '404' , $validator->errors() );
        }

        $prescription = Prescription::create($request->all());

        $prescription['Main_drug'] = Drug::find($request->drug_id);
        $prescription['repetation'] = Repetation::find($request->repetation_id);
        $prescription['duration'] = Duration::find($request->duration_id);
        $prescription['medical_case'] = MedicalCase::find($request->medical_case_id);
        $prescription['alternative_drug'] = Drug::find($request->alternative_drug_id) ?? null;
        $prescription['quantity'] = $request->quantity ?? null;
        $prescription['kind'] = kind::find($request->kind_id) ?? null;

        return $this->successMessage($prescription , '200');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prescription = Prescription::find($id);
        if($prescription)
            return $this->successMessage($prescription , '200');
        else
            return $this->errorMessage(null , '404' , '');
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
        $prescription = Prescription::find($id);

        $validator = Validator::make($request->all(),[
            'drug_id' => 'required',
            'medical_case_id' => 'required',
            'repetation_id' => 'required',
            'duration_id' => 'required',
            'note' => 'required|string',
        ]);

        if($validator->fails()){
            return $this->errorMessage(null , '404' , $validator->errors() );
        }

        $prescription->update($request->all());

        $prescription['Main_drug'] = Drug::find($request->drug_id);
        $prescription['repetation'] = Repetation::find($request->repetation_id);
        $prescription['duration'] = Duration::find($request->duration_id);
        $prescription['medical_case'] = MedicalCase::find($request->medical_case_id);
        $prescription['alternative_drug'] = Drug::find($request->alternative_drug_id) ?? null;
        $prescription['quantity'] = $request->quantity ?? null;
        $prescription['kind'] = kind::find($request->kind_id) ?? null;

        return $this->successMessage($prescription , '200');
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
