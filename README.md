# tempo-php-sdk

This package provides a (currently) super simple interface to allow retrieval of Tempo worklogs from the Atlassian JIRA Tempo servlet API.

## Installation

Use `composer` to get the job done:

```bash
composer require causelabs/tempo-php-sdk
```

## Usage

Using the API consists of two steps: creating a transport client, and passing it into the API.

### Transport Client

It's easiest to simply used the included Guzzle-based client. If you want to create your own, simply implement `CauseLabs\Interfaces\ClientInterface`.

```php
use CauseLabs\TempoAPI\GuzzleClient;

$url = 'https://yourjirainstance.jira.com';
$key = 'your-tempo-api-key';

$client = new GuzzleClient($url, $key);
```

## API Instantiation

After instantiating a client, you can set up the API connection:

```php
use CauseLabs\TempoAPI\GuzzleClient;
use CauseLabs\TempoAPI\API;

$url = 'https://yourjirainstance.jira.com';
$key = 'your-tempo-api-key';

$client = new GuzzleClient($url, $key);
$api = new API($client);

// Get worklogs for a specific user
$username = 'john_doe';
$start = new DateTime;
$end = new DateTime;

$worklogs = $api->worklogs($username, $start, $end);
```

## License

MIT

## Contact

Contact Mark Horlbeck at mark@causelabs.com for contributions, questions, etc.
