<?php

namespace App\Models\Professionist;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = ['curriculum', 'pic', 'phone', 'description', 'profession_id', 'address', 'user_id', 'id'];

    public function professions()
    {
        return $this->belongsToMany(Profession::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
