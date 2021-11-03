<?php

namespace Eudonet;

class EudonetCatalog
{
    const BASE_ENDPOINT = 'Catalog';

    /** @var EudonetClient */
    private $client;

    /**
     * EudonetCatalog constructor.
     */
    public function __construct(EudonetClient $client)
    {
        $this->client = $client;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function get(int $descId)
    {
        return $this->client->get(self::BASE_ENDPOINT.'/'.$descId);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function getUsers(array $data = [])
    {
        return $this->client->post(self::BASE_ENDPOINT.'/Users', $data);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function search(array $data = [])
    {
        return $this->client->post(self::BASE_ENDPOINT.'/Search', $data);
    }
}
