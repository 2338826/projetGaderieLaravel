<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    // Désactiver les timestamps
    public $timestamps = false;

    // Définir les attributs fillable
    protected $fillable = ['description'];

    // Relation avec Nursery (une State peut avoir plusieurs Nurseries)
    public function nurseries()
    {
        return $this->hasMany(Nursery::class, 'id_state');
    }




}
