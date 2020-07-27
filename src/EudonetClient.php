<?php

namespace Eudonet;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use function GuzzleHttp\Psr7\stream_for;
use Psr\Http\Message\ResponseInterface;
use function json_decode;

class EudonetClient
{
    const BASE_URI = 'my.eudonet.com/eudoapi/';

    /**
     * @var EudonetAuthenticate
     */
    public $authenticate;

    /**
     * @var EudonetSearch
     */
    public $search;

    /**
     * @var EudonetCUD
     */
    public $cud;

    /**
     * @var EudonetAnnexe
     */
    public $annexe;

    /**
     * @var Client
     */
    private $httpClient;

    /**
     * @var EudonetToken|null
     */
    private $token;

    /**
     * @var string
     */
    protected $subscriberLogin;

    /**
     * @var string
     */
    protected $subscriberPassword;

    /**
     * @var string
     */
    protected $baseName;

    /**
     * @var string
     */
    protected $userLogin;

    /**
     * @var string
     */
    protected $userPassword;

    /**
     * @var string
     */
    protected $userLang;

    /**
     * @var string
     */
    protected $productName;

    /**
     * EudonetClient constructor.
     *
     * @param string $subscriberLogin
     * @param string $subscriberPassword
     * @param string $baseName
     * @param string $userLogin
     * @param string $userPassword
     * @param string $userLang
     * @param string $productName
     */
    public function __construct($subscriberLogin, $subscriberPassword, $baseName, $userLogin, $userPassword, $userLang, $productName)
    {
        $this->setDefaultClient();

        $this->subscriberLogin = $subscriberLogin;
        $this->subscriberPassword = $subscriberPassword;
        $this->baseName = $baseName;
        $this->userLogin = $userLogin;
        $this->userPassword = $userPassword;
        $this->userLang = $userLang;
        $this->productName = $productName;

        $this->authenticate = new EudonetAuthenticate($this);
        $this->search = new EudonetSearch($this);
        $this->cud = new EudonetCUD($this);
        $this->annexe = new EudonetAnnexe($this);
    }

    private function setDefaultClient()
    {
        $this->http_client = new Client();
    }

    /**
     * Sets GuzzleHttp client.
     *
     * @param Client $client
     */
    public function setClient($client)
    {
        $this->http_client = $client;
    }

    /**
     * @return EudonetToken|null
     */
    public function getToken()
    {
        return $this->token;
    }

    public function setToken(EudonetToken $token)
    {
        $this->token = $token;
    }

    public function resetToken()
    {
        $this->token = null;
    }

    public function authenticate()
    {
        $this->token->getToken();
    }

    /**
     * Sends POST request to Eudonet API.
     *
     * @param string $endpoint
     * @param array  $datas
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function post($endpoint, $datas = [], $anonymous = false)
    {
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];

        if (!$anonymous) {
            $headers['x-auth'] = $this->getToken()->getToken();
        }

        $response = $this->http_client->request('POST', $this->getUri().$endpoint, [
            'json' => $datas,
            'headers' => $headers,
        ]);

        return $this->handleResponse($response);
    }

    /**
     * Sends PUT request to Eudonet API.
     *
     * @param string $endpoint
     * @param array  $datas
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function put($endpoint, $datas = [])
    {
        $response = $this->http_client->request('PUT', $this->getUri().$endpoint, [
            'json' => $datas,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'x-auth' => $this->getToken()->getToken(),
            ],
        ]);

        return $this->handleResponse($response);
    }

    /**
     * Sends DELETE request to Eudonet API.
     *
     * @param string $endpoint
     * @param array  $datas
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function delete($endpoint, $datas = [])
    {
        $response = $this->http_client->request('DELETE', $this->getUri().$endpoint, [
            'json' => $datas,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'x-auth' => $this->getToken()->getToken(),
            ],
        ]);

        return $this->handleResponse($response);
    }

    /**
     * @param string $endpoint
     * @param array  $$datas
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function get($endpoint, $datas = [])
    {
        $response = $this->http_client->request('GET', $this->getUri().$endpoint, [
            'query' => $datas,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'x-auth' => $this->getToken()->getToken(),
            ],
        ]);

        return $this->handleResponse($response);
    }

    /**
     * @return array
     */
    public function getAuth()
    {
        return [
            'SubscriberLogin' => $this->subscriberLogin,
            'SubscriberPassword' => $this->subscriberPassword,
            'BaseName' => $this->baseName,
            'UserLogin' => $this->userLogin,
            'UserPassword' => $this->userPassword,
            'UserLang' => $this->userLang,
            'ProductName' => $this->productName,
        ];
    }

    /**
     * Returns Eudonet API Uri.
     *
     * @return string
     */
    public function getUri()
    {
        return 'https://'.self::BASE_URI;
    }

    /**
     * @return mixed
     */
    private function handleResponse(ResponseInterface $response)
    {
        $stream = stream_for($response->getBody());
        $data = json_decode($stream);

        return $data;
    }
}
