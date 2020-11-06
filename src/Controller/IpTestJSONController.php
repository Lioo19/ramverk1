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
    public function indexAction() : object
    {
        $page = $this->di->get("page");
        $data = [
            "content" => $this->getDetailsOnRequest(__METHOD__),
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

        $validation = new Iptest($userip);
        $ip4 = $validation->ip4test();
        $ip6 = $validation->ip6test();

        if ($ip6 || $ip4) {
            $hostname = gethostbyaddr($userip);
        } else {
            $hostname = "Ej korrekt ip";
        }

        $data = [
            "ip" => $userip,
            "ip4" => $ip4,
            "ip6" => $ip6,
            "hostname" => $hostname,
        ];

        $page->add("ip/validation", $data);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This sample method dumps the content of $di.
     * GET mountpoint/dump-app
     *
     * @return string
     */
    public function dumpDiActionGet() : string
    {
        // Deal with the action and return a response.
        $services = implode(", ", $this->di->getServices());
        return __METHOD__ . "<p>\$di contains: $services";
    }



    /**
     * Add the request method to the method name to limit what request methods
     * the handler supports.
     * GET mountpoint/info
     *
     * @return string
     */
    public function infoActionGet() : string
    {
        // Deal with the action and return a response.
        return __METHOD__ . ", \$db is {$this->db}";
    }



    /**
     * This sample method action it the handler for route:
     * GET mountpoint/create
     *
     * @return string
     */
    public function createActionGet() : string
    {
        // Deal with the action and return a response.
        return __METHOD__ . ", \$db is {$this->db}";
    }



    /**
     * This sample method action it the handler for route:
     * POST mountpoint/create
     *
     * @return string
     */
    public function createActionPost() : string
    {
        // Deal with the action and return a response.
        return __METHOD__ . ", \$db is {$this->db}";
    }



    /**
     * This sample method action takes one argument:
     * GET mountpoint/argument/<value>
     *
     * @param mixed $value
     *
     * @return string
     */
    public function argumentActionGet($value) : string
    {
        // Deal with the action and return a response.
        return __METHOD__ . ", \$db is {$this->db}, got argument '$value'";
    }



    /**
     * This sample method action takes zero or one argument and you can use - as a separator which will then be removed:
     * GET mountpoint/defaultargument/
     * GET mountpoint/defaultargument/<value>
     * GET mountpoint/default-argument/
     * GET mountpoint/default-argument/<value>
     *
     * @param mixed $value with a default string.
     *
     * @return string
     */
    public function defaultArgumentActionGet($value = "default") : string
    {
        // Deal with the action and return a response.
        return __METHOD__ . ", \$db is {$this->db}, got argument '$value'";
    }



    /**
     * This sample method action takes two typed arguments:
     * GET mountpoint/typed-argument/<string>/<int>
     *
     * NOTE. Its recommended to not use int as type since it will still
     * accept numbers such as 2hundred givving a PHP NOTICE. So, its better to
     * deal with type check within the action method and throuw exceptions
     * when the expected type is not met.
     *
     * @param mixed $value with a default string.
     *
     * @return string
     */
    public function typedArgumentActionGet(string $str, int $int) : string
    {
        // Deal with the action and return a response.
        return __METHOD__ . ", \$db is {$this->db}, got string argument '$str' and int argument '$int'.";
    }



    /**
     * This sample method action takes a variadic list of arguments:
     * GET mountpoint/variadic/
     * GET mountpoint/variadic/<value>
     * GET mountpoint/variadic/<value>/<value>
     * GET mountpoint/variadic/<value>/<value>/<value>
     * etc.
     *
     * @param array $value as a variadic parameter.
     *
     * @return string
     */
    public function variadicActionGet(...$value) : string
    {
        // Deal with the action and return a response.
        return __METHOD__ . ", \$db is {$this->db}, got '" . count($value) . "' arguments: " . implode(", ", $value);
    }



    /**
     * Adding an optional catchAll() method will catch all actions sent to the
     * router. You can then reply with an actual response or return void to
     * allow for the router to move on to next handler.
     * A catchAll() handles the following, if a specific action method is not
     * created:
     * ANY METHOD mountpoint/**
     *
     * @param array $args as a variadic parameter.
     *
     * @return mixed
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function catchAll(...$args)
    {
        // Deal with the request and send an actual response, or not.
        //return __METHOD__ . ", \$db is {$this->db}, got '" . count($args) . "' arguments: " . implode(", ", $args);
        $page = $this->di->get("page");
        $data = [
            "content" => $this->getDetailsOnRequest(__METHOD__, $args),
        ];
        $page->add("anax/v2/article/default", $data);

        return $page->render([
            "title" => __METHOD__,
        ]);
    }
}
