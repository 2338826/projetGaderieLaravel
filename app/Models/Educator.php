<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Educator extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'firstName', 'birth_date', 'adress', 'city', 'phone', 'id_state'];
    public function state()
    {
        return $this->belongsTo(State::class, 'id_state');
    }
}
