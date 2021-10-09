<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'identificador',
        'correo',
        'telefono'
    ];

    #Forma singular -> Por que una persona solo puede pertenecer a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
        #Estoy en instancia de persona, puedo acceder a metodo user para acceder a la informacion del usuario
    }
}
