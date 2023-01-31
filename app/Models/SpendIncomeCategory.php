<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpendIncomeCategory extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'category_name', 'category_type_id'];
}
