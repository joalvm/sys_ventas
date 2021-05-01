<?php

namespace App\Models;

use App\Traits\Validatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UnidadMedida extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Validatable;

    protected $table = 'unidad_medida';
    protected $fillable = [
        'nombre',
        'prefijo',
    ];

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:30'],
            'prefijo' => ['required', 'string', 'max:5'],
        ];
    }
}
