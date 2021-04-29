<?php

namespace App\Models;

use App\Traits\Validatable;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoDocumento extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Validatable;

    public const OPERATION_PERSONA = 'PERSONA';
    public const OPERATION_COMPROBANTE = 'COMPROBANTE';

    public const ALLOWED_OPERATION = [
        self::OPERATION_COMPROBANTE,
        self::OPERATION_PERSONA,
    ];

    protected $table = 'tipo_documento';
    protected $fillable = [
        'nombre',
        'operacion',
    ];

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = mb_strtoupper($value, 'utf-8');
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:45'],
            'operacion' => ['required', 'string', Rule::in(self::ALLOWED_OPERATION)],
        ];
    }
}
