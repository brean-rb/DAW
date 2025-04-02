<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Fruta;

class Origen extends Model
{
    protected $table = 'origenes';
    protected $fillable = [
        'origen'
    ];

    public function frutas()
    {
        return $this->hasMany(Fruta::class);
    }
}
