<?php
namespace Lioo19\Models;

/**
 * Class for checking IP-adress to ip4 and ip6 standard.
 * Class only contain methods for checking
 *
 */
class IpDefault
{
    /**
     * defaultIp from users adress
     *
     * @return string $ipdefault
     */
    public function getDefaultIp($request) : string
    {
        $key = "REMOTE_ADDR";
        $data = $request->getServer($key);
        if ($data) {
            return $data;
        } else {
            return "";
        }
    }
}
