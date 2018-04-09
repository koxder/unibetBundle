# UnibetBundle

Bundle to handle the UNIBET API. More information here:
   - https://developer.kindredgroup.com/docs/sportsbook.html

## Configuration

You should send as argument these vars when you instance the client.

``` yml
app_key [required] = app key of unibet.

app_id [required] = app id of unibet.

type_of_bet [optional] =
            [ 0 = Only request Match Bets,
              1 = Get all bets for each match
            ]

response    [optional] =
            [ 'json' = Return data in JSON format.
              'xml' = Return data in XML format.
            ]
```

## Example

``` php
use UnibetApiClient\Client;
use UnibetApiClient\NotFoundException;

$client = new Client(["app_key" => "secret_app_key",
                   "app_id" => "secret_api_key",
                   "type_of_bet" => 1,
                   "response" => 'json'
                    ]);

try{
    $bets = $client->getBets('123456677');
    print_r($bets);
}catch (NotFoundException $e){
    print("Resource not found");
}

```



## Test Unit

```sh
docker build -t unibet .
docker run -v $(pwd):/app --rm -it unibet vendor/bin/phpunit tests/UnibetClientTest.php
```

## Using docker

```sh
docker run -v $(pwd):/app --rm -it composer/composer install
```
