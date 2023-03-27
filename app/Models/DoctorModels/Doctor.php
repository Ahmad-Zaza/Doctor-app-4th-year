<?php

namespace App\Models\DoctorModels;

use App\Models\DrugAllergen;
use App\Models\DrugPermanent;
use App\Models\MedicalCase;
use App\Models\PatientModels\Patient;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\CanResetPassword;
//use Illuminate\Auth\Passwords\CanResetPassword;
use League\CommonMark\Extension\Table\Table;

class Doctor extends Authenticatable implements JWTSubject
{
    use HasFactory;
    use Notifiable;

    protected $guard = 'doctor-api';

    protected $table = 'doctors';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'avatar',
        'password',
        'username',
        'speciality_id',
        'hospital_id',
        'experience',
        'about_you',
        'picked_appointment',
        'created_at',
        'updated_at'
    ];


    // jwt overrided functions
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // my functions
    public function CheckDoctorClinics($doctor)
    {
        if (count($doctor->clinics()->get())) {
            return true;
            //return $doctor->clinics()->get();
        }
        return false;
    }

    public function doctorSpeciality($id){
        $speciality = Speciality::find($id);
        return $speciality;
    }

    public function doctorHospital($id){
        $hospital = Hospital::find($id);
        return $hospital;
    }

    // %%%%%%%%%%%%%%%%%%%%%%%%%%%% start getters %%%%%%%%%%%%%%%%%%%%%

    // %%%%%%%%%%%%%%%%%%%%%%%%%%%% end getters %%%%%%%%%%%%%%%%%%%%%


    // %%%%%%%%%%%%%%%%%%%%%%%%%%%% setters %%%%%%%%%%%%%%%%%%%%%
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function setSpecialityIdAttribute($value)
    {
        $this->speciality_id = Speciality::select('id')->where('id' , $value);
        //$value ? Speciality::find($value) : null;
    }

    public function setHospitalIdAttribute($value)
    {
        $this->hospital_id = Hospital::select('id')->where('id' , $value);
        //$value ? Hospital::find($value) : null;
    }
    // public function setSpecialityIdAttribute($value){
    //     if($value === null){
    //         $this->attributes['speciality_id'] = null;
    //     }
    // }


    // public function setHospitalIdAttribute($value){
    //     if($value === null){
    //         $this->attributes['hospital_id'] = null;
    //     }
    // }


    // public function setExperienceAttribute($value){
    //     if($value === null){
    //         $this->attributes['experience'] = null;
    //     }
    // }


    // public function setAboutYouAttribute($value){
    //     if($value === null){
    //         $this->attributes['about_you'] = null;
    //     }
    // }



    // public function setPickedAppointmentAttribute($value){
    //     if($value === null){
    //         $this->attributes['picked_appointment'] = null;
    //     }
    // }
    // %%%%%%%%%%%%%%%%%%%%%%%%%%%% end setters %%%%%%%%%%%%%%%%%%%%%



    // %%%%%%%%%%%%%%%%%%%%%%%%%%%% start relationships functions %%%%%%%%%%%%%%%%%%%%%
    public function clinics()
    {
        return $this->hasMany(Clinic::class);
    }

    public function speicialty()
    {
        return $this->belongsTo(Speciality::class);
    }

    public function hospital()
    {
        return $this->belongsTo(Speciality::class);
    }

    public function favouritePatients()
    {
        return $this->belongsToMany(Patient::class, 'favourite_patients', 'doctor_id', 'patient_id', 'id', 'id');
    }

    // this function return the patients who add this doctor to their favourite list
    public function patientsLikeDoctor()
    {
        return $this->belongsToMany(Patient::class, 'favourite_doctors', 'doctor_id', 'patient_id', 'id', 'id');
    }

    public function medicalCases(){
        return $this->hasMany(MedicalCase::class);
    }
    // %%%%%%%%%%%%%%%%%%%%%%%%%%%% end relationships functions %%%%%%%%%%%%%%%%%%%%%
}
