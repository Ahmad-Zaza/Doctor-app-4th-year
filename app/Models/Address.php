<?php

namespace App\Models;

use App\Models\DoctorModels\Clinic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    public function areas(){
        return $this->hasMany(Area::class);
    }

    public function clinics(){
        return $this->hasMany(Clinic::class);
    }
}
