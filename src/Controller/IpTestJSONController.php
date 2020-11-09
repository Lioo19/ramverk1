<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Controller\Iptest;

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
    * @var bool $resultIp4 returns true if Ip4-validation goes through
    * @var bool $resultIp6 returns true if Ip6-validation goes through
     */

    public $resultIp4 = null;
    public $resultIp6 = null;


    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    public function initialize() : void
    {
        // Use to initialise member variables.
        $this->db = "active";
    }

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
                    <p>\$db is '{$this->db}'.</p>
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
    public function indexAction() : array
    {
        $request = $this->di->get("request");
        //request to get GET-info
        $userip = $request->getGet("ip", "Ingen ip angiven");

        if ($userip) {
            $validation = new Iptest($userip);
            $ip4 = $validation->ip4test();
            $ip6 = $validation->ip6test();
        }

        if ($ip6 || $ip4) {
            $hostname = gethostbyaddr($userip);
        } else {
            $hostname = "Ej korrekt ip";
        }

        $data = [
            "ip" => $userip,
            "ip4" => $ip4,
            "ip6" => $ip6,
            "host" => $hostname,
        ];

        return [$data];
    }
}
