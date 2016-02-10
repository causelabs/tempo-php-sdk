<?php

use CauseLabs\TempoAPI\API;
use CauseLabs\Mocks\MockClient as Client;

use DateTime;
use DateInterval;

class APITest extends PHPUnit_Framework_TestCase
{
    private function getConfig()
    {
        return [
            'key'  => 'some-key',
            'url'  => 'https://some-url.jira.com',
            'user' => 'john_doe',
        ];
    }

    public function testCanGetEntries()
    {
        $config = $this->getConfig();

        $client = new Client($config['url'], $config['key']);
        $api = new API($client);
        $end = new DateTime('2016-02-08');
        $start = new DateTime('2016-02-08');

        $results = $api->worklogs($config['user'], $start, $end);
        $this->assertGreaterThan(0, count($results));
    }
}
