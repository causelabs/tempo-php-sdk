<?php

namespace CauseLabs\TempoAPI;

use GuzzleHttp\Client;
use CauseLabs\TempoAPI\Interfaces\ClientInterface;

class GuzzleClient implements ClientInterface
{
    const API_URL = '/plugins/servlet/';

    /**
     * @var string
     */
    protected $key;

    /**
     * @var Client
     */
    protected $client;

    public function __construct($url, $key)
    {
        $this->client = new Client([
            'base_uri' => $url . self::API_URL
        ]);
        $this->key = $key;
    }

    /**
     * {@inheritdoc}
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * {@inheritdoc}
     */
    public function get($url)
    {
        $response = $this->client->get($url);
        return (string) $response->getBody();
    }
}
