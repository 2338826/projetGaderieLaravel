<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// This is the State model class
// extends the Model class
// This class is used to manage the state
class State extends Model
{
    use HasFactory;

    // Disable timestamps for this model
    public $timestamps = false;

    // Define the table associated with the model
    protected $fillable = ['description'];

    // Define the primary key for the model
    public function nurseries()
    {
        return $this->hasMany(Nursery::class, 'id_state');
    }




}
