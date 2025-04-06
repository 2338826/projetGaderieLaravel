<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    // Define timestamps for this model
    public $timestamps = false;

    // Define the table associated with the model
    protected $fillable = ['dateTime', 'amount', 'nursery_id', 'commerce_id', 'category_expense_id'];

    // function to define the primary key for the model
    public function commerce()
    {
        return $this->belongsTo(Commerce::class, 'commerce_id');
    }
    // function to define the primary key for the model
    public function expenseCategory()
    {
        return $this->belongsTo(ExpenseCategory::class, 'category_expense_id');
    }

}
