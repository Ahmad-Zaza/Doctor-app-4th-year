<?php

namespace App\Models;

use App\Models\DoctorModels\Clinic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'address_id',
    ];

    public $timestamps = false;

    public function address(){
        return $this->belongsTo(Address::class);
    }

    public function clinics(){
        return $this->hasMany(Clinic::class);
    }

}
