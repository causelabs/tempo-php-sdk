<?php

namespace CauseLabs\TempoAPI;

use CauseLabs\TempoAPI\Interfaces\ClientInterface;

use SimpleXMLElement;
use DateTime;

class API
{
    const URL_ENTRIES = 'tempo-getWorkLog/?dateFrom=%s&dateTo=%s&addIssueSummary=true&addIssueDetails=true&userName=%s&format=xml&tempoApiToken=%s';

    const DATE_FORMAT = 'Y-m-d';

    /**
     * @var ClientInterface
     */
    protected $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Returns the current Tempo transport client
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Retrieves worklogs for the specified username over the specified date
     * range
     *
     * @param  string   $user  Username for which to retrieve logs
     * @param  DateTime $start Date from which to start retrieving logs
     * @param  DateTime $end   Date to which to end retrieving logs
     * @return array
     */
    public function worklogs($user, DateTime $start, DateTime $end)
    {
        try {
            $response = $this->client->get(vsprintf(self::URL_ENTRIES, [
                $start->format(self::DATE_FORMAT),
                $end->format(self::DATE_FORMAT),
                $user,
                $this->client->getKey(),
            ]));
        }
        catch (\Exception $e) {
            die ($e->getMessage());
        }

        return $this->parseWorklogData($response);
    }

    /**
     * Parses raw XML response from Tempo API into worklog array
     *
     * @param  mixed $xml  Raw XML response
     * @return array
     */
    private function parseWorklogData($xml)
    {
        $nodes = new SimpleXMLElement((string) $xml);

        $results = [];

        foreach ($nodes->worklog as $log) {
            $results[] = [
                'id'        => (string) $log->worklog_id,
                'date'      => new DateTime((string) $log->work_date),
                'key'       => (string) $log->issue_key,
                'name'      => (string) $log->issue_summary,
                'hours'     => (float) $log->hours,
                'notes'     => (string) $log->work_description,
            ];
        }

        return $results;
    }
}
