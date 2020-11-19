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
class GeoController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function getDetailsOnRequest(
        string $method,
        array $args = []
    ) : string {
                $request        = $this->di->get("request");
                $path           = $request->getRoute();
                $httpMethod     = $request->getMethod();
                $numArgs        = count($args);
                $strArgs        = implode(", ", $args);
                $queryString    = http_build_query($request->getGet(), '', ', ');

                return <<<EOD
                    <h1>$method</h1>

                    <p>The request was '$path' ($httpMethod).</p>
                    <p>Got '$numArgs' arguments: '$strArgs'.</p>
                    <p>Query string contains: '$queryString'.</p>
                EOD;
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : object
    {
        $page = $this->di->get("page");
        $request = $this->di->get("request");
        $ipDefault = $this->di->get("ipdefault");
        $usersIp = $ipDefault->getDefaultIp($request);

        $data = [
            "content" => $this->getDetailsOnRequest(__METHOD__),
            "defaultIp" => $usersIp,
        ];

        //MAPPEN inte url
        $page->add("ip/iptest", $data);

        return $page->render([
            "title" => __METHOD__,
        ]);
    }

    /**
     * POST for ip, redirects to result-page
     * Sends the ip-adress with post and redirects
     *
     * @return object
     */
    public function validationActionPost() : object
    {
        $request = $this->di->get("request");
        $page = $this->di->get("page");
        $title = "Validera IP";
        //request to get the posted information
        $userip = $request->getPost("ipinput", null);

        $validation = $this->di->get("iptest");
        $validation->setInput($userip);

        $ip4 = $validation->ip4test();
        $ip6 = $validation->ip6test();

        if ($ip6 || $ip4) {
            $hostname = gethostbyaddr($userip);
            $geo = $this->di->get("ipgeo")
            $geo->setInput($userip);
            $geoInfo = $geo->fetchGeo();
        } else {
            $hostname = "Ej korrekt ip";
            $geoInfo = "Inget att visa";
        }

        $data = [
            "ip" => $userip,
            "ip4" => $ip4,
            "ip6" => $ip6,
            "hostname" => $hostname,
            "geoInfo" => $geoInfo,
        ];

        $page->add("ip/validation", $data);

        return $page->render([
            "title" => $title,
        ]);
    }



//can I split all the functions?
//     /**
//      * POST for ip, redirects to result-page
//      * Sends the ip-adress with post and redirects
//      *
//      * @return object
//      */
//     private function validateIP($userip) : object
//     {
//         $validation = new IpTest($userip);
//         $ip4 = $validation->ip4test();
//         $ip6 = $validation->ip6test();
//
//         $data = [
//             "ip" => $userip,
//             "ip4" => $ip4,
//             "ip6" => $ip6,
//         ];
//
//         return $data;
//     }
}
