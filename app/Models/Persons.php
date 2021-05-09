<?php

namespace App\Models;

use App\Traits\Validatable;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Persons extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Validatable;

    public const GENDER_MALE = 'MALE';
    public const GENDER_FEMALE = 'FEMALE';
    public const GENDER_OTHERS = 'OTHERS';

    public const ALLOWED_GENDERS = [
        self::GENDER_MALE,
        self::GENDER_FEMALE,
        self::GENDER_OTHERS,
    ];

    protected $table = 'persons';
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'gender',
        'phone',
        'avatar_url',
    ];

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:80'],
            'lastname' => ['required', 'string', 'max:80'],
            'email' => ['required', 'string', 'email'],
            'gender' => ['required', 'string', Rule::in(self::ALLOWED_GENDERS)],
            'phone' => ['nullable', 'string', 'max:80'],
            'avatar_url' => ['nullable', 'string', 'max:150'],
        ];
    }

    public function user(): HasOne
    {
        return $this->hasOne(Users::class);
    }
}
