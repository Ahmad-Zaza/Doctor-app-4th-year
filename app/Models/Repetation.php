<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repetation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function prescription(){
        return $this->belongsTo(Prescription::class);
    }
}
