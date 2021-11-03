<?php

namespace Eudonet;

/**
 * Class EudonetAuthenticate.
 */
class EudonetAuthenticate
{
    const BASE_ENDPOINT = 'Authenticate';

    /** @var EudonetClient */
    private $client;

    /**
     * EudonetAuthenticate constructor.
     */
    public function __construct(EudonetClient $client)
    {
        $this->client = $client;
    }

    /**
     * Get Authentification token.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return EudonetToken
     */
    public function getToken()
    {
        if ($token = $this->client->getToken()) {
            if (!$token->isExpired()) {
                return $token;
            }

            $this->client->resetToken();
        }

        /** @var \stdClass $data */
        $data = $this->client->post(self::BASE_ENDPOINT.'/Token', $this->client->getAuth(), true);

        if (isset($data->ResultInfos) && isset($data->ResultInfos->Success) && !$data->ResultInfos->Success) {
            throw new \Exception(sprintf('Authentification failed. %s [%d]', $data->ResultInfos->ErrorMessage, $data->ResultInfos->ErrorNumber));
        }

        $token = new EudonetToken(
            $data->ResultData->Token,
            new \DateTime($data->ResultData->ExpirationDate),
            new \DateTime($data->ResultData->ServerDate)
        );

        $this->client->setToken($token);

        return $token;
    }
}
