<?php

namespace App\Models\Professionist;

use App\Models\Professionist\Profile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sponsorship extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'duration', 'profile_id'];

    public function profiles()
    {
        return $this->belongsToMany(Profile::class)
            ->withPivot('startDate')
            ->withPivot('endDate')
            ->withTimestamps();
    }
}
