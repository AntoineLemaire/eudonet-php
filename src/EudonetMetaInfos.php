<?php

namespace Eudonet;

class EudonetMetaInfos
{
    const BASE_ENDPOINT = 'MetaInfos';

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
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function get(int $descId, bool $allFields = true, array $fields = [])
    {
        return $this->client->post(self::BASE_ENDPOINT.'/', [
            'Tables' => [
                'DescId' => 0,
                'AllFields' => $allFields,
                'Fields' => $fields,
            ],
        ]);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return mixed
     */
    public function listTabs(array $fields)
    {
        return $this->client->get(self::BASE_ENDPOINT.'/ListTabs/', $fields);
    }
}
