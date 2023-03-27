<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'name',
        'price',
        'company',
        'scientificName',
    ];

    public function patientPermanentDrugs()
    {
        return $this->belongsToMany('App\Models\PatientModels\Patient', 'drug_permanents','drug_id', 'patient_id', 'id', 'id');
    }

    public function PatientAllergensDrugs()
    {
        return $this->belongsToMany('App\Models\PatientModels\Patient' , 'drug_allergens' , 'drug_id' , 'patient_id' , 'id' , 'id');
    }

    public function PatientChronicDrugs(){
        return $this->belongsToMany('App\Models\PatientModels\Patient' , 'drug_chronics' , 'drug_id' , 'patient_id' , 'id' , 'id');
    }


}
