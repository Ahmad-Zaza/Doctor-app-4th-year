<?php

namespace App\Models\PatientModels;

use App\Models\DoctorModels\Doctor;
use App\Models\Drug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Patient extends Authenticatable implements JWTSubject
{
    use HasFactory;
    use Notifiable;

    protected $guard = 'patient-api';
    protected $fillable = [
        'id',
        'fullName',
        'fatherName',
        'motherName',
        'password',
        'phoneNumber',
        'nationalityID',
        'email',
        'userName',
        'work',
        'avatarID',
        'gender',
        'bloodSymbol',
        'addressDetails'
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
    // setters
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
    //getters


    public function permanentDrugs()
    {
        return $this->belongsToMany(Drug::class, 'drug_permanents', 'patient_id', 'drug_id', 'id', 'id');
    }

    public function allergensDrugs()
    {
        return $this->belongsToMany(Drug::class, 'drug_allergens', 'patient_id', 'drug_id', 'id', 'id');
    }

    public function chronicDrugs(){
        return $this->belongsToMany(Drug::class , 'drug_chronics' , 'patient_id' , 'drug_id' , 'id' , 'id');
    }
    // this function return the doctors that make this patient on their favourite list
    public function doctorsLikePatient()
    {
        return $this->belongsToMany(Patient::class, 'favourite_patients', 'patient_id', 'doctor_id', 'id', 'id');
    }

    public function favouriteDoctors()
    {
        return $this->belongsToMany(Doctor::class, 'favourite_doctors', 'patient_id', 'doctor_id', 'id', 'id');
    }

    public function medicalCases(){
        return $this->hasMany(MedicalCase::class);
    }
}
