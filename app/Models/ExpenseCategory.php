<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    use HasFactory;

    // Define timestamps for this model
    public $timestamps = false;

    // Define the table associated with the model
    protected $fillable = ['description', 'pourcentage'];

    // function to define the primary key for the model
    public function expenses()
    {
        return $this->hasMany(Expense::class, 'category_expense_id');
    }
}
