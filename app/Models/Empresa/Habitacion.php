<?php

namespace App\Models\Empresa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Habitacion extends Model
{
    use HasFactory,Notifiable;
    protected $table = "habitacions";
    protected $guarded = ['id'];
    //----------------------------------------------------------------------------------
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotels_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
