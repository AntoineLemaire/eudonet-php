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
     * Get file by ID.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function getFile($tabId, $fileId)
    {
        return $this->client->get(self::BASE_ENDPOINT.'/'.$tabId.'/'.$fileId);
    }

    /**
     * Advanced Search.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function advancedSearch($tabId, $datas)
    {
        return $this->client->post(self::BASE_ENDPOINT.'/'.$tabId, $datas);
    }

    /**
     * Fast Search.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function fastSearch($tabId, $datas)
    {
        return $this->client->post(self::BASE_ENDPOINT.'/Fast/'.$tabId, $datas);
    }

    /**
     * Search the list of occupied planning dates according to the provided criteria.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function planningOccupied($datas)
    {
        return $this->client->post(self::BASE_ENDPOINT.'/PlanningOccupied/', $datas);
    }
}
