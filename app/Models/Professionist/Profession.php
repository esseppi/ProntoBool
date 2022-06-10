<?php

namespace App\Models\Professionist;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;

    protected $primaryKey = 'profession_id';
    protected $fillable = ['name'];

    // static public function create()
    // {
    // }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
}
