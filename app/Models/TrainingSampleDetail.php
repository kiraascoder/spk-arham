<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingSampleDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_sample_id',
        'criterion_id',
        'option_value',
        'numeric_value',
        'normalized_value',
    ];

    protected $casts = [
        'numeric_value' => 'decimal:2',
    ];

    public function trainingSample()
    {
        return $this->belongsTo(TrainingSample::class, 'training_sample_id');
    }

    public function criterion()
    {
        return $this->belongsTo(Criterion::class, 'criterion_id');
    }
}
