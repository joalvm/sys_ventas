<?php

namespace App\Models;

use App\Traits\Validatable;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Users extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Validatable;

    protected $table = 'users';
    protected $fillable = [
        'persons_id',
        'username',
        'password',
        'salt',
        'recovery_token',
        'verification_token',
        'verified_at',
    ];

    public function rules(): array
    {
        return [
            'persons_id' => [
                'required',
                'integer',
                Rule::exists('persons', 'id')->whereNull('deleted_at'),
            ],
            'username' => ['required', 'string', 'max:15', 'min:6'],
            'password' => ['required', 'string'],
            'salt' => ['required', 'string', 'max:16'],
        ];
    }

    // public function reloadPassword(): self
    // {
    //     $salt = Str::random();

    //     $password = Hash::make(
    //         $salt . '.' . $this->getAttribute('password'),
    //         ['rounds' => 14]
    //     );

    //     $this->setAttribute('salt', $salt);
    //     $this->setAttribute('password', $password);

    //     $this->update();

    //     return $this;
    // }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Persons::class);
    }
}
