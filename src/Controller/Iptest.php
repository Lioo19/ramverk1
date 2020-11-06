<?php
namespace Anax\Controller;

/**
 * Class for checking IP-adress to ip4 and ip6 standard.
 * Class only contain methods for checking
 *
 */
class Iptest
{
    /**
    * @var string $ipinput   userinputted ip
    */
    private $ipinput;

    /**
     * Constructor to assign user input
     *
     * @param null|string    $ipinp  User input
     */
    public function __construct(string $ipinp = "")
    {

        $this->ipinput = $ipinp;
    }

    /**
    * method for checking Ip4
    * @return bool if valid, return true
    */
    public function ip4test()
    {
        if (filter_var($this->ipinput, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return true;
        }
        return false;
    }

    /**
    * method for checking Ip6
    * IF THE CHECK WORKS, TRY MAKE ONE FUNCTION OUT OF THESE
    * @return bool if valid, return true
    */
    public function ip6test()
    {
        if (filter_var($this->ipinput, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return true;
        }
        return false;
    }
}
