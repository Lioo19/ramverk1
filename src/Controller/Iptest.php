<?php
namespace Anax\Controller;

/**
 * Class for checking IP-adress to ip4 and ip6 standard.
 *
 */
class Iptest
{
    /**
    * @var string $ipinput   userinputted ip
    */
    private $ipinput;
    protected $ip4;
    protected $ip6;

    /**
     * Constructor to assign user input
     *
     * @param null|string    $ipinp  User input
     */
    public function __construct(string $ipinp = "")
    {
        // if (!(is_int($nrOfSides) || $nrOfSides > 0)) {
        //     throw new SidesException("Sides on dice need to be at least 1");
        // }

        $this->ipinput = $ipinp;
    }

    /**
    * method for checking IP4
    * @return bool $ip4
    */
    public function ip4check()
    {
        $this->thrown = rand(1, $this->sides);
        $this->lastRoll = $this->thrown;
        return $this->lastRoll;
    }

    /**
    * method for checking IP4
    * @return bool $ip4
    */
    public function ip4check()
    {
        $this->thrown = rand(1, $this->sides);
        $this->lastRoll = $this->thrown;
        return $this->lastRoll;
    }

    /**
    * method to access the lastroll
    *
    * @return int $lastRoll
    */
    public function getLastRoll()
    {
        return $this->lastRoll;
    }
}
