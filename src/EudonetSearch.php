<?php

namespace Eudonet;

/**
 * Class EudonetSearch.
 */
class EudonetSearch
{
    const BASE_ENDPOINT = 'Search';

    /** @var EudonetClient */
    private $client;

    /**
     * EudonetSearch constructor.
     *
     * @param EudonetClient $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Get file by ID
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function getFile($tabId, $fileId)
    {
        return $this->client->get(self::BASE_ENDPOINT."/".$tabId.'/'.$fileId);
    }

    /**
     * Gets a single User with their ID.
     *
     * @param int $id
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function getUser($id)
    {
        $path = $this->userPath($id);

        return $this->client->get($path);
    }

    /**
     * @param $id
     *
     * @return string
     */
    public function userPath($id)
    {
        return self::BASE_ENDPOINT.'/'.$id;
    }
}
