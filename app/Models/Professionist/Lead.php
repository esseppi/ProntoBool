<?php

namespace App\Models\Professionist;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'message',
        'phone',
        'profile_id',
        'created_at',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
