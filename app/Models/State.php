<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
<<<<<<< HEAD
    // Désactiver les timestamps
    public $timestamps = false;

    // Définir les attributs fillable
    protected $fillable = ['description'];

    // Relation avec Nursery (une State peut avoir plusieurs Nurseries)
    public function nurseries()
    {
        return $this->hasMany(Nursery::class, 'id_state');
    }
=======

    protected $fillable = ['name'];
>>>>>>> cf26b2d41ec563cf66e2c9508e178034558bee9c
}
