<?php

namespace Eudonet;

class EudonetCUD
{
    const BASE_ENDPOINT = 'CUD';

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
     * @param int $tabId
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function insert($tabId, array $fields)
    {
        return $this->client->post(self::BASE_ENDPOINT.'/'.$tabId, $fields);
    }

    /**
     * @param $tabId
     * @param $fileId
     * @param $fields
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function update($tabId, $fileId, $fields)
    {
        return $this->client->post(self::BASE_ENDPOINT.'/'.$tabId.'/'.$fileId, $fields);
    }
}
