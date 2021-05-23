<?php

namespace App\Listeners;

use App\Models\Sessions;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Jenssegers\Agent\Agent;

class LoginListener
{
    /**
     * @var \Jenssegers\Agent\Agent
     */
    private $agent;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        $this->agent = new Agent();
    }

    /**
     * Handle the event.
     *
     * @param object $event
     */
    public function handle($event)
    {
        /** @var \App\Models\Users $user */
        $user = $event->user;

        $this->agent->setUserAgent($this->userAgent());
        $this->agent->setHttpHeaders(request()->headers->all());

        $session = $user->sessions()->make([
            'ip_address' => $this->ipAddress(),
            'platform' => $this->platform(),
            'platform_version' => $this->platformVersion(),
            'browser' => $this->browser(),
            'browser_version' => $this->browserVersion(),
            'device' => $this->device(),
            'user_agent' => $this->userAgent(),
        ]);

        $session->save();

        $this->makeApiToken($session);
    }

    protected function makeApiToken(Sessions $sessions)
    {
        $issuedAt = Carbon::now()->unix();
        $expire = Carbon::now()->addRealHours(24);

        $token = JWT::encode([
            'iss' => request()->getHost(),
            'sub' => $sessions->users_id,
            'jti' => $sessions->id,
            'iat' => $issuedAt,
            'exp' => $expire->unix(),
        ], Config::get('app.key'));

        $sessions->setAttribute('token', $token);
        $sessions->setAttribute('expire', $expire);

        $sessions->update();

        Session::put('token', $token);
    }

    protected function platform(): string
    {
        return $this->agent->platform();
    }

    protected function platformVersion(): string
    {
        return $this->agent->version($this->platform());
    }

    protected function browser(): string
    {
        return $this->agent->browser();
    }

    protected function browserVersion(): string
    {
        return $this->agent->version($this->browser());
    }

    protected function device(): string
    {
        $device = Sessions::DEVICE_UNKNOWN;

        if ($this->agent->isDesktop()) {
            $device = Sessions::DEVICE_DESKTOP;
        } elseif ($this->agent->isTablet()) {
            $device = Sessions::DEVICE_TABLET;
        } elseif ($this->agent->isMobile() or $this->agent->isPhone()) {
            $device = Sessions::DEVICE_MOBILE;
        }

        return $device;
    }

    /**
     * Get the IP address for the current request.
     *
     * @return string
     */
    protected function ipAddress()
    {
        return request()->ip();
    }

    /**
     * Get the user agent for the current request.
     *
     * @return string
     */
    protected function userAgent()
    {
        return substr((string) request()->header('User-Agent'), 0, 500);
    }
}
