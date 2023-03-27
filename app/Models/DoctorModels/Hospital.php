<?php

namespace App\Models\DoctorModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];


    public function doctors (){
        return $this -> hasMany(Doctor::class);
    }
}
