<?php

namespace Eudonet;

class EudonetToken
{
    /** @var string */
    private $token;

    /** @var \DateTime */
    private $expirationDate;

    /** @var \DateTime */
    private $serverDate;

    /**
     * EudonetToken constructor.
     */
    public function __construct(string $token, \DateTime $expirationDate, \DateTime $serverDate)
    {
        $this->token = $token;
        $this->expirationDate = $expirationDate;
        $this->serverDate = $serverDate;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return \DateTime
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * @return \DateTime
     */
    public function getServerDate()
    {
        return $this->serverDate;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @throws \Exception
     *
     * @return bool
     */
    public function isExpired()
    {
        $now = new \DateTime();

        return $this->expirationDate < $now;
    }
}
