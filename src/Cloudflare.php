<?php

declare(strict_types=1);

namespace Foodticket\Cloudflare;

use Cloudflare\API\Adapter\Guzzle;
use Cloudflare\API\Auth\APIKey;
use Cloudflare\API\Endpoints\AccessRules;
use Cloudflare\API\Endpoints\Crypto;
use Cloudflare\API\Endpoints\DNS;
use Cloudflare\API\Endpoints\FirewallSettings;
use Cloudflare\API\Endpoints\IPs;
use Cloudflare\API\Endpoints\LoadBalancers;
use Cloudflare\API\Endpoints\Membership;
use Cloudflare\API\Endpoints\Pools;
use Cloudflare\API\Endpoints\Railgun;
use Cloudflare\API\Endpoints\SSL;
use Cloudflare\API\Endpoints\TLS;
use Cloudflare\API\Endpoints\UARules;
use Cloudflare\API\Endpoints\User;
use Cloudflare\API\Endpoints\WAF;
use Cloudflare\API\Endpoints\ZoneLockdown;
use Cloudflare\API\Endpoints\Zones;
use Cloudflare\API\Endpoints\ZoneSettings;
use Foodticket\Cloudflare\Endpoints\Images;

class Cloudflare
{
    private Guzzle $adapter;

    public function __construct(string $apiEmail, string $apiKey)
    {
        $this->adapter = $this->adapter($apiEmail, $apiKey);
    }

    public function crypto(): Crypto
    {
        return new Crypto($this->adapter);
    }

    public function dns(): DNS
    {
        return new DNS($this->adapter);
    }

    public function firewallSettings(): FirewallSettings
    {
        return new FirewallSettings($this->adapter);
    }

    public function images(): Images
    {
        return new Images($this->adapter);
    }

    public function ips(): IPs
    {
        return new IPs($this->adapter);
    }

    public function accessRules(): AccessRules
    {
        return new AccessRules($this->adapter);
    }

    public function loadBalance(): LoadBalancers
    {
        return new LoadBalancers($this->adapter);
    }

    public function membership(): Membership
    {
        return new Membership($this->adapter);
    }

    public function pool(): Pools
    {
        return new Pools($this->adapter);
    }

    public function railgun(): Railgun
    {
        return new Railgun($this->adapter);
    }

    public function ssl(): SSL
    {
        return new SSL($this->adapter);
    }

    public function tls(): TLS
    {
        return new TLS($this->adapter);
    }

    public function uARules(): UARules
    {
        return new UARules($this->adapter);
    }

    public function user(): User
    {
        return new User($this->adapter);
    }

    public function waf(): WAF
    {
        return new WAF($this->adapter);
    }

    public function zoneLockdown(): ZoneLockdown
    {
        return new ZoneLockdown($this->adapter);
    }

    public function zones(): Zones
    {
        return new Zones($this->adapter);
    }

    public function zoneSettings(): ZoneSettings
    {
        return new ZoneSettings($this->adapter);
    }

    private function adapter(
        string $apiEmail,
        string $apiKey,
    ): Guzzle {
        $key = new APIKey($apiEmail, $apiKey);

        return new Guzzle($key);
    }
}
