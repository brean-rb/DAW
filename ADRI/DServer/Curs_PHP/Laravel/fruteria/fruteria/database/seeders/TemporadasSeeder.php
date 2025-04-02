<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Temporada;

class TemporadasSeeder extends Seeder
{
    /**
     
Run the database seeds.*/
  public function run(): void{$array = ['INVIERNO','PRIMAVERA','VERANO','OTOÑO','TODAS'];
      foreach ($array as $temp) {Temporada::create(['temporada' => $temp]);}}
}