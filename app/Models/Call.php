<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $fillable = [
        'call_sid',
        'status',
        'duration',
    ];

    public function caller()
    {
      return $this->belongsTo(User::class, 'caller_user_id')
    }

    public function receiver()
    {
      return $this->belongsTo(User::class, 'receiver_user_id')
    }
}
