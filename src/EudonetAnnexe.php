<?php


namespace Eudonet;


class EudonetAnnexe
{
    const BASE_ENDPOINT = 'Annexes';

    /** @var EudonetClient */
    private $client;

    /**
     * EudonetCUD constructor.
     *
     * @param EudonetClient $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * @param array $fields
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function add(array $fields)
    {
        return $this->client->post(self::BASE_ENDPOINT.'/Add',  $fields);
    }
}
