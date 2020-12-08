<?php

namespace Lioo19\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class IpTestJSONController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return array
     */
    public function indexActionGet() : array
    {
        $request = $this->di->get("request");
        //request to get GET-info
        $userip = $request->getGet("ip", "Ingen ip angiven");

        if ($userip) {
            $validation = $this->di->get("iptest");
            $validation->setInput($userip);
            $ip4 = $validation->ip4test();
            $ip6 = $validation->ip6test();
        }

        if ($ip6 || $ip4) {
            $hostname = gethostbyaddr($userip);
            $geoInfo = $this->getGeo($userip);
        } else {
            $hostname = "Ej korrekt ip";
            $geoInfo = "Inget att visa";
        }

        $data = [
            "ip" => $userip,
            "ip4" => $ip4,
            "ip6" => $ip6,
            "host" => $hostname,
            "geoInfo" => $geoInfo,
        ];

        return [$data];
    }

    public function getGeo($userip)
    {
        $geo = $this->di->get("ipgeo");
        $geo->setInput($userip);
        $geoInfo = $geo->fetchGeo();

        return $geoInfo;
    }
}
