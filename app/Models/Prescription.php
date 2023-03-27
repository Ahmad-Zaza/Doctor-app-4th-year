<?php

namespace App\Models;

use App\Models\Duration as ModelsDuration;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Duration;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_case_id',
        'drug_id',
        'alternative_drug_id',
        'repetation_id',
        'duration_id',
        'note',
        'quantity',
        'kind_id',
    ];

    public $timestamps = false;

    public function medicalCase()
    {
        return $this->BelongsTo(MedicalCase::class, 'medical_case_id');
    }

    public function duration()
    {
        return $this->hasOne(Duration::class);
    }

    public function kind()
    {
        return $this->hasOne(kind::class);
    }

    public function repetation()
    {
        return $this->hasOne(Repetation::class);
    }

    public function mainDrug()
    {
        return $this->hasOne(Drug::class, 'drug_id');
    }

    public function alternativeDrug()
    {
        return $this->hasOne(Drug::class, 'alternative_drug_id');
    }
}
