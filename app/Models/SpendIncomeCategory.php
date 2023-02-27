<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpendIncomeCategory extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'category_name', 'record_type_id'];

    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class)->get();
    }
}
