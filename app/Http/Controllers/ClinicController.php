<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\DoctorModels\Doctor;
use App\Models\Address;
use App\Models\DoctorModels\Clinic;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Traits\QueryTrait;

class ClinicController extends Controller
{
    use QueryTrait;
    public function __construct()
    {
        $this->middleware('assign.guard:doctor-api')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clinics = Clinic::all();
        if ($clinics) {
            return response()->json([
                'result' => $clinics,
                'code' => '200',
            ], 200);
        } else {
            return response()->json([
                'result' => null,
                'code' => '414',
            ], 414);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'doctor_id' => 'required',
                'address_id' => 'required',
                'area_id' => 'required',
                'address_details' => 'required',
                'open_at' => 'required|string',
                'closed_at' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'result' => null,
                    'code' => '404',
                ], 404);
            }

            $clinic = Clinic::create($request->all());

            return response()->json([
                'result' => $clinic,
                'code' => '200',
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                //'result' => 'we catched error',
                'result' => $ex->getMessage(),
            ], $ex->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clinic = Clinic::find($id);
        if ($clinic) {
            return response()->json([
                'result' => $clinic,
                'code' => '200',
            ], 200);
        } else {
            return response()->json([
                'result' => null,
                'code' => '414',
            ], 414);
        }
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
        $clinic = Clinic::find($id);
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required',
            'address_id' => 'required',
            'area_id' => 'required',
            'address_details' => 'required',
            'open_at' => 'required|string',
            'closed_at' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'result' => null,
                'code' => '404',
            ], 404);
        }

        if (!$request['avatar'])
            $request['avatar'] = $clinic['avatar'];
        if (!$request['open_at'])
            $request['open_at'] = $clinic['open_at'];
        if (!$request['closed_at'])
            $request['closed_at'] = $clinic['closed_at'];

        $clinic->update($request->all());

        return response()->json([
            'result' => $clinic,
            'code' => '200',
        ], 200);
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


    public function GetDocotrCilnics($id)
    {
        $auth_doctor = auth('doctor-api')->user();
        $doctor = Doctor::find($id);
        if (!$this->checkUserToken($auth_doctor, $doctor)) {
            return response()->json([
                'result' => null,
                'msg' => 'You Can Not Get Another Doctor Clinics!!',
                'code' => '414',
            ], 414);
        }
        // the parameter must be query not collection...
        $doctor['clinics'] = $this->doPagination(request()->all(), $doctor->clinics());
        foreach ($doctor['clinics'] as $clinic) {
            $clinic['address'] = Address::find($clinic->address_id);
            $clinic['area'] = Area::find($clinic->area_id);
        }
        return response()->json([
            'result' => $doctor,
            'code' => '200',
        ], 200);
    }

    public function getAdresses()
    {
        $adresses = Address::all();
        if ($adresses) {
            return response()->json([
                'result' => $adresses,
                'code' => '200',
            ], 200);
        } else {
            return response()->json([
                'result' => null,
                'code' => '414',
            ], 414);
        }
    }

    public function getAreas($address_id)
    {
        $address = Address::find($address_id);
        $areas = $address->areas()->get();

        return response()->json([
            'result' => $areas,
            'code' => '200',
        ], 200);
    }
}
