<?php

namespace Foodticket\Cloudflare\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Cloudflare\API\Endpoints\Crypto crypto()
 * @method static \Cloudflare\API\Endpoints\DNS dns()
 * @method static \Cloudflare\API\Endpoints\FirewallSettings firewallSettings()
 * @method static \Foodticket\Cloudflare\Endpoints\Images images()
 * @method static \Cloudflare\API\Endpoints\IPs ips()
 * @method static \Cloudflare\API\Endpoints\AccessRules accessRules()
 * @method static \Cloudflare\API\Endpoints\LoadBalancers loadBalance()
 * @method static \Cloudflare\API\Endpoints\Membership membership()
 * @method static \Cloudflare\API\Endpoints\Pools pool()
 * @method static \Cloudflare\API\Endpoints\Railgun railgun()
 * @method static \Cloudflare\API\Endpoints\SSL ssl()
 * @method static \Cloudflare\API\Endpoints\TLS tls()
 * @method static \Cloudflare\API\Endpoints\UARules uARules()
 * @method static \Cloudflare\API\Endpoints\User user()
 * @method static \Cloudflare\API\Endpoints\WAF waf()
 * @method static \Cloudflare\API\Endpoints\ZoneLockdown zoneLockdown()
 * @method static \Cloudflare\API\Endpoints\Zones zones()
 * @method static \Cloudflare\API\Endpoints\ZoneSettings zoneSettings()
 *
 * @see \Foodticket\Cloudflare\Endpoints\Images
 */
class Cloudflare extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-cloudflare';
    }
}
