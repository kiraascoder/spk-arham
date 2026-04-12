<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'classification_code',
        'predicted_class',
        'probability_unggul',
        'probability_tidak_unggul',
        'calculation_details',
        'pdf_path',
    ];

    protected $casts = [
        'probability_unggul' => 'decimal:6',
        'probability_tidak_unggul' => 'decimal:6',
        'calculation_details' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(ClassificationDetail::class, 'classification_id');
    }
}
