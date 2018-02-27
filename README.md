# UnibetBundle

Bundle to handle the UNIBET API. More information here:
   - https://developer.kindredgroup.com/docs/sportsbook.html

# Configuration

You should send as argument these vars when you instance the client.


APP_KEY [required]
APP_ID [required]
TYPE_OF_BET [optional] =
            [ 0 = Only request Match Bets,
              1 = Get all bets for each match
            ]
Response [optional] =
            [ 'json' = Return data in JSON format.
              'xml' = Return data in XML format.
            ]

# Example

$var = new Client(["app_key" => "secret_app_key",
                   "app_id" => "secret_api_key",
                   "type_of_bet" => 1,
                   "response" => json
                    ]);



# Test Unit
docker build -t unibet .
docker run -v $(pwd):/app --rm -it unibet vendor/bin/phpunit tests/UnibetClientTest.php

# Composer
docker run -v $(pwd):/app --rm -it composer/composer install
