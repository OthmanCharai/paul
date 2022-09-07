<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use PhpParser\Node\Scalar\String_;

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
    protected $appends=['fullname','user'];

    public function meets():HasMany{
        return $this->hasMany(Meet::class);
    }
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * getFullNameAttribute
     *
     * @return string
     */
    public function getFullNameAttribute():String{
        return $this->first_name." ".$this->last_name;
    }

    /**
     * @return
     */
    public function getUserAttribute(){
        return $this->user();
    }



}
