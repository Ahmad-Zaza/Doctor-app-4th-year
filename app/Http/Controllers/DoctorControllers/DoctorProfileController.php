<?php

namespace App\Http\Controllers\DoctorControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DoctorModels\Doctor;
use Illuminate\Support\Facades\Validator;
use App\Traits\QueryTrait;

class DoctorProfileController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $doctor = Doctor::find($id);
        $validator = Validator::make($request->all() , [
            'username' => 'required|string|unique:doctors|max:25',
        ]);
        if ($validator->fails()) {
            return $this->errorMessage(null , '400' , $validator->errors());
        }
        $doctor->update($request->all());
        return $this->successMessage($doctor , '200');
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
