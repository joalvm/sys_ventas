<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class Usuario extends User
{
    use HasFactory;
    use Notifiable;

    protected $table = 'usuario';
    protected $fillable = [
        'sucursal_id',
        'empleado_id',
        'tipo_usuario',
        'fecha_registro',
        'mnu_almacen',
        'mnu_compras',
        'mnu_ventas',
        'mnu_mantenimiento',
        'mnu_seguridad',
        'mnu_consulta_compras',
        'mnu_consulta_ventas',
        'mnu_admin',
        'estado',
    ];

    public function empleado(): BelongsTo
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id');
    }
}
