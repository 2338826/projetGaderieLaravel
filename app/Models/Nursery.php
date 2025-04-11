<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// This is the Nursery model class
// extends the Model class
// This class is used to manage the nursery
class Nursery extends Model
{
    use HasFactory;

    // Disable timestamps for this model
    public $timestamps = false;

    // Define the table associated with the model
    protected $fillable = ['name', 'address', 'city', 'phone', 'id_state'];

    // function to define the primary key for the model
    public function state()
    {
        return $this->belongsTo(State::class, 'id_state');
    }
    public function expenses()
    {
        return $this->hasMany(Expense::class, 'nursery_id');
    }

}

