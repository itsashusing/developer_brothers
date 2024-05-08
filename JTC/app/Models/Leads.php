<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leads extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'address',
        'time',
        'fo_id'
    ];
    public function FO()
    {
        return $this->belongsTo(Fo::class, 'fo_id', 'id');
    }
}
