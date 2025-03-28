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

    //     protected $fillable = ['name', 'address', 'phone', 'email'];

    //     public function state ()
//     {
//         return $this->belongsTo(State::class);
// >>>>>>> cf26b2d41ec563cf66e2c9508e178034558bee9c
//     }
}

