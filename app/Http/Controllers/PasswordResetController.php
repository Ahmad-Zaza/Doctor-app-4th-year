<?php

namespace App\Http\Controllers;


use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Models\DoctorModels\Doctor;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\SendMail;
use Carbon\Carbon;

class PasswordResetController extends Controller
{
    public function sendPasswordResetEmail(Request $request){
        // If email does not exist
        //return response($this->generateCode());
        if(!$this->validEmail($request->email)) {
            return response()->json([
                'message' => 'Email does not exist.'
            ], Response::HTTP_NOT_FOUND);
        } else {
            // If email exists
            $this->sendMail($request->email);
            return response()->json([
                'message' => 'Check your inbox, we have sent a link to reset email.'
            ], Response::HTTP_OK);
        }
    }


    public function sendMail($email){
        //$token = $this->generateToken($email);
        $code = $this->generateCode($email);

        //return response($code);
        Mail::to($email)->send(new sendMail($code));
    }

    public function validEmail($email) {
       return !!Doctor::where('email', $email)->first();
    }

    // public function generateToken($email){
    //   $isOtherToken = DB::table('password_resets')->where('email', $email)->first();

    //   if($isOtherToken) {
    //     return $isOtherToken->token;
    //   }

    //   $token = Str::random(80);;
    //   $this->storeToken($token, $email);
    //   return $token;
    // }

    // public function storeToken($token, $email){
    //     DB::table('password_resets')->insert([
    //         'email' => $email,
    //         'token' => $token,
    //         'created_at' => Carbon::now()
    //     ]);
    // }

    public function generateCode($email){
        $isOtherCode = DB::table('code_reset')->where('email', $email)->first();

      if($isOtherCode) {
        return $isOtherCode->code;
      }

      $code = Str::random(6);;
      $this->storeCode($code, $email);
      return $code;
    }

    public function storeCode($code, $email){
        DB::table('code_reset')->insert([
            'email' => $email,
            'code' => $code,
            'created_at' => Carbon::now()
        ]);
    }



    // public function storeToken($token, $email){
    //     DB::table('password_resets')->insert([
    //         'email' => $email,
    //         'token' => $token,
    //         'created_at' => Carbon::now()
    //     ]);
    //     return Str::random(6);
    // }
}
