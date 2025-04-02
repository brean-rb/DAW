<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Temporada;
use App\Models\Origen;

class Fruta extends Model
{
    protected $table = 'frutas';
    protected $fillable = ['nombre', 'precio', 'temporada_id', 'origen_id'];

    public function temporada()
    {
        return $this->belongsTo(Temporada::class);
    }

    public function origen()
    {
        return $this->belongsTo(Origen::class);
    }
}
