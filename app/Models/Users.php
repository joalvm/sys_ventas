<?php

namespace App\Models;

use App\Traits\Validatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class Users extends User
{
    use HasFactory;
    use SoftDeletes;
    use Validatable;

    protected $table = 'users';
    protected $fillable = [
        'person_id',
        'username',
        'password',
        'salt',
        'recovery_token',
        'verification_token',
        'verified_at',
        'remember_token',
        'enabled',
    ];

    protected $attributes = [
        'enabled' => true,
    ];

    protected $casts = [
        'enabled' => 'boolean',
    ];

    public function rules(): array
    {
        return [
            'person_id' => [
                'required',
                'integer',
                Rule::exists('persons', 'id')->whereNull('deleted_at'),
            ],
            'username' => ['required', 'string', 'max:15', 'min:6'],
            'password' => ['required', 'string'],
            'salt' => ['required', 'string', 'max:16'],
            'enabled' => ['nullable', 'boolean'],
        ];
    }

    public function hashPassword(): self
    {
        $salt = Str::random();

        $password = Hash::make(
            sprintf('%s.%s', $salt, $this->getAttribute('password')),
            ['rounds' => 14]
        );

        $this->setAttribute('password', $password);
        $this->setAttribute('salt', $salt);

        return $this;
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Persons::class);
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(Sessions::class);
    }
}
