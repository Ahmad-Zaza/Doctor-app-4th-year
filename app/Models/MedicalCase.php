<?php

namespace App\Models;

use App\Models\DoctorModels\Doctor;
use App\Models\PatientModels\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalCase extends Model
{

    // $table->id();
    // $table->integer('doctor_id');
    // $table->integer('patient_id');
    // $table->text('title');
    // $table->integer('clinic_id');
    // $table->longText('description');
    // $table->string('date');
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'patient_id',
        'clinic_id',
        'title',
        'description',
        'date'
    ];
    public $timestamps = false;


    public function doctor()
    {
        $this->belongsToMany(Doctor::class);
    }


    public function patient()
    {
        $this->belongsToMany(Patient::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'medical_case_id');
    }

    public function Consultations()
    {
        return $this->hasMany(Consultation::class , 'medical_case_id' , 'id');
    }
}
