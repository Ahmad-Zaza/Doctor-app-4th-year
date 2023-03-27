<?php

namespace App\Models\DoctorModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;

    protected $table = 'specialities';

    protected $fillable = ['title'];

    public function doctor()
    {
        return $this->hasMany(Doctor::class);
    }
}
