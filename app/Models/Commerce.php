<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commerce extends Model
{
    use HasFactory;
    // Disable timestamps for this model
    public $timestamps = false;

    // Define the table associated with the model
    protected $fillable = ['description', 'address', 'phone'];

    // function to define the primary key for the model
    public function expenses()
    {
        return $this->hasMany(State::class, 'commerce_id');
    }
}
