<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empleado extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'empleado';
    protected $fillable = [
        'apellidos',
        'nombre',
        'tipo_documento',
        'num_documento',
        'direccion',
        'telefono',
        'email',
        'fecha_nacimiento',
        'foto',
        'login',
        'clave',
        'estado',
    ];

    public function usuario(): HasOne
    {
        return $this->hasOne(Usuario::class, 'empleado_id', 'id');
    }
}
