<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Fruta;
class Temporada extends Model
{
    protected $table = 'temporadas';
    protected $fillable = [
        'temporada'
    ];

    public function frutas()
    {
        return $this->hasMany(Fruta::class);
    }
}
