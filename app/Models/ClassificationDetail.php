<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassificationDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'classification_id',
        'criterion_id',
        'input_value',
        'normalized_value',
    ];

    public function classification()
    {
        return $this->belongsTo(Classification::class, 'classification_id');
    }

    public function criterion()
    {
        return $this->belongsTo(Criterion::class, 'criterion_id');
    }
}
