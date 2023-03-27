<?php

namespace App\Models\DoctorModels;

use App\Models\Address;
use App\Models\Area;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctor_id',
        'avatar',
        'address_id',
        'area_id',
        'address_details',
        'phone_number',
        'open_at',
        'closed_at',
    ];

    public $timestamps = false;

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }


    public function address(){
        return $this->belongsTo(Address::class);
    }

    public function area(){
        return $this->belongsTo(Area::class);
    }

}
