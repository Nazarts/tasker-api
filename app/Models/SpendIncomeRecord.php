<?php

namespace App\Models;

use Database\Factories\SpendIncomeRecordFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpendIncomeRecord extends Model
{
    use HasFactory;

    protected $fillable = ['task_name', 'category_id', 'record_time', 'sum'];

    protected static function newFactory()
    {
        return SpendIncomeRecordFactory::new();
    }

    public function category() {
        return $this->belongsTo(SpendIncomeCategory::class);
    }
}
