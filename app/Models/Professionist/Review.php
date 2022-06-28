<?php

namespace App\Models\Professionist;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'name',
        'email',
        'message',
        'vote',
        'created_at'
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
