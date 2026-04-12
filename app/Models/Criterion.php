<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criterion extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'input_type',
        'description',
    ];

    public function options()
    {
        return $this->hasMany(CriterionOption::class, 'criterion_id');
    }

    public function trainingSampleDetails()
    {
        return $this->hasMany(TrainingSampleDetail::class, 'criterion_id');
    }

    public function classificationDetails()
    {
        return $this->hasMany(ClassificationDetail::class, 'criterion_id');
    }
}
