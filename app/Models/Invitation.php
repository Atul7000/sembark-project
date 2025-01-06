<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = ['email', 'token', 'role', 'client_id', 'expires_at', 'is_signed_up'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
