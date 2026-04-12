<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriterionOption extends Model
{
    use HasFactory;

    protected $table = 'criteria_options';

    protected $fillable = [
        'criterion_id',
        'option_code',
        'option_label',
    ];

    public function criterion()
    {
        return $this->belongsTo(Criterion::class, 'criterion_id');
    }
}
