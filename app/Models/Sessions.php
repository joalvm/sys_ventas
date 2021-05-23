<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sessions extends Model
{
    use HasFactory;

    public const UPDATED_AT = null;

    public const DEVICE_MOBILE = 'MOBILE';
    public const DEVICE_DESKTOP = 'DESKTOP';
    public const DEVICE_TABLET = 'TABLET';
    public const DEVICE_UNKNOWN = 'UNKNOWN';

    public const DEFAULT_DEVICE = self::DEVICE_UNKNOWN;

    protected $table = 'user_sessions';
    protected $fillable = [
        'users_id',
        'token',
        'expire',
        'ip_address',
        'platform',
        'platform_version',
        'browser',
        'browser_version',
        'device',
        'user_agent',
        'closed_at',
    ];

    protected $attributes = [
        'device' => self::DEFAULT_DEVICE,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class);
    }
}
