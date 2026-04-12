<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingSample extends Model
{
    use HasFactory;

    protected $fillable = [
        'sample_code',
        'class_label',
        'source_data',
        'notes',
    ];

    public function details()
    {
        return $this->hasMany(TrainingSampleDetail::class, 'training_sample_id');
    }
}
