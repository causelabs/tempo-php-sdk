<?php

namespace CauseLabs\TempoAPI\Interfaces;

interface ClientInterface
{
    /**
     * Utilizes an HTTP GET to a specific URL from the Tempo API
     *
     * @param  string $url URL from which to retrieve data
     * @return string      Response body content
     */
    public function get($url);

    /**
     * Returns the Tempo API token/key
     *
     * @return string
     */
    public function getKey();
}
