<?php

namespace App\Models\Empresa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Hotel extends Model
{
    use HasFactory,Notifiable;
    protected $table = "hotels";
    protected $guarded = ['id'];
    //----------------------------------------------------------------------------------
    public function acomodacion()
    {
        return $this->hasMany(Habitacion::class, 'hotels_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
