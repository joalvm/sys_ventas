<?php

namespace App\Authentication;

use Illuminate\Auth\EloquentUserProvider as BaseEloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Str;

class EloquentUserProvider extends BaseEloquentUserProvider
{
    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials)) {
            return;
        }

        $query = $this->createModel()->newQuery();

        foreach ($credentials as $key => $value) {
            if (!Str::contains($key, 'password')) {
                $query->where($key, $value);
            }
        }

        return $query->first()->load('person');
    }

    /**
     * @param \App\Models\Users $user
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return $this->hasher->check(
            sprintf(
                '%s.%s',
                $user->getAttribute('salt'),
                $credentials['password'] ?? ''
            ),
            $user->getAuthPassword()
        );
    }
}
