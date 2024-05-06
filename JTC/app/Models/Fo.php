<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fo extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->fo_code = 'JTC' . str_pad(self::count() + 1, 4, '0', STR_PAD_LEFT);
        });
    }

    public function leads(){
        return $this->hasMany(Leads::class, 'fo_id', 'id');
    }
}
