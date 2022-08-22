<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Meet extends Model
{
    use HasFactory;
    protected $fillable=[
        'status',
        'date',
        'user_id',
        'doctor_id'
    ];

    public function users():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function doctors():BelongsTo{
        return $this->belongsTo(Doctor::class);
    }
}