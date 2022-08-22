<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctor extends Model
{
    protected $fillable=[
        'first_name',
        'last_name',
        'phone',
        'address',
        'speciality'
    ];
    
    public function meets():HasMany{
        return $this->hasMany(Meet::class);
    }
}