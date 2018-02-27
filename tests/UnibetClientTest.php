<?php

/**
 *  Corresponding Class to test YourClass class
 *
 *  For each class in your library, there should be a corresponding Unit-Test for it
 *  Unit-Tests should be as much as possible independent from other test going on.
 *
 *  @author cduran
 */
use UnibetApiClient\Client;
use UnibetApiClient\NotFoundException;

class UnibetClientTest extends PHPUnit_Framework_TestCase{


    private $client;

    function setUp() {
        $this->client = new Client([]);
    }

    public function testIsThereAnySyntaxError(){
        $var = new Client();
        $this->assertTrue(is_object($var));
        unset($var);
    }


    function testItShouldGetGroups() {
        $response = $this->client->getGroups();
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
        $this->assertArrayHasKey('group', $response);
    }

    function testItShouldGetEvents() {
        $response = $this->client->getEvents("1000095049");
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
        $this->assertArrayHasKey('events', $response);
    }

    function testItShouldGetBets() {
        $response = $this->client->getBets("1004161576");
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
        $this->assertArrayHasKey('betoffers', $response);
    }

    function testItShouldGetSupportedPlaces() {
        $response = $this->client->getSupportedPlaces();
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
        $this->assertArrayHasKey('jurisdiction', $response[0]);
    }

    function testNotFoundException() {
        $this->setExpectedException(NotFoundException::class);
        $response = $this->client->getBets("10041613821");
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
        $this->assertArrayHasKey('betoffers', $response);
    }

}
