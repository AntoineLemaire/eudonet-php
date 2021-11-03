<?php

namespace Eudonet;

class EudonetAnnexe
{
    const BASE_ENDPOINT = 'Annexes';

    /** @var EudonetClient */
    private $client;

    /**
     * EudonetAnnexe constructor.
     *
     * @param EudonetClient $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function add(array $fields)
    {
        return $this->client->post(self::BASE_ENDPOINT.'/Add', $fields);
    }
}
