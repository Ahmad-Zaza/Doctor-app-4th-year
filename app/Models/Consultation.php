<?php

namespace App\Models;

use App\Models\DoctorModels\Doctor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_case_id',
        'speciality',
        'content',
        'date',
    ];

    public $timestamps = false;

    public function medicalCase()
    {
        return $this->belongsTo(MedicalCase::class, 'medical_case_id' , 'id');
    }

    public function doctors(){
        return $this->hasMany(Doctor::class);
    }
}
