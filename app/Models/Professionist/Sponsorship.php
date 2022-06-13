<?php

namespace App\Models\Professionist;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    use HasFactory;
    protected $fillable = ['startDate', 'endDate', 'bundle', 'profile_id'];
}
