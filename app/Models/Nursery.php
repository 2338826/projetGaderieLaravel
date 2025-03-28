<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nursery extends Model
{
    use HasFactory;

    // Désactiver les timestamps
    public $timestamps = false;

    // Définir les attributs fillable
    protected $fillable = ['name', 'address', 'city', 'phone', 'id_state'];

    // Relation avec State (une Nursery appartient à un State)
    public function state()
    {
        return $this->belongsTo(State::class, 'id_state');
    }

}

