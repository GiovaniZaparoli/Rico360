<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{

    protected $fillable = [
        'call_sid',
        'status',
        'duration',
    ];

    public function receiver()
    {
      return $this->belongsTo(User::class, 'receiver_user_id');
    }
}
