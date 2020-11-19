<?php
namespace Lioo19\Models;

/**
 * Class for checking IP-adress to ip4 and ip6 standard.
 * Class only contain methods for checking
 *
 */
class IpTest
{
    /**
    * @var string $ipinput   userinputted ip
    */
    private $ipinput;

    /**
     * Function to set user ip
     *
     * @param null|string    $ipinp  User input
     */
    public function setInput(string $ipinp = "")
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
