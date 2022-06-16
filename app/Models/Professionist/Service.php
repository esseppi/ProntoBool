<?php

namespace App\Models\Professionist;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'desc',
        'price',
        'profession_id',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
