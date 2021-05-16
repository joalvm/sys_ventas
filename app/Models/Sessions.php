<?php

namespace App\Models;

use App\Traits\Validatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Validation\Rule;

class Sessions extends Model
{
    use HasFactory;
    use Validatable;

    public const UPDATED_AT = null;

    protected $table = 'user_sessions';
    protected $fillable = [
        'user_id',
        'token',
        'expire',
        'ip',
        'platform',
        'browser',
        'browser_version',
        'closed_at',
    ];

    public function rules(): array
    {
        return [
            'user_id' => [
                'required',
                'integer',
                Rule::exists('users', 'id')->whereNull('deleted_at'),
            ],
            'token' => ['required', 'string'],
            'expire' => ['requred', 'date_format:Y-m-d H:i:s'],
            'ip' => ['required', 'ip', 'max:16'],
            'platform' => ['nullable', 'string', 'max:25'],
            'browser' => ['nullable', 'string', 'max:25'],
            'browser_version' => ['nullable', 'string', 'max:25'],
            'closed_at' => ['nullable', 'date_format:Y-m-d H:i:s'],
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class);
    }
}
