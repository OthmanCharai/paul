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
        'speciality',
        'user_id'
        
    ];
    protected $appends=['fullname'];
    
    public function meets():HasMany{
        return $this->hasMany(Meet::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute(){
        return $this->first_name." ".$this->last_name;
    }
}