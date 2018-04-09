<?php

namespace UnibetApiClient;

use UnibetApiClient\Configuration as ConfigurationUnibet;
use UnibetApiClient\NotFoundException as NotFoundExceptionUnibet;
use GuzzleHttp\Client as GuzzleClient;

/**
*  A sample class
*
*  Use this section to define what this class is doing, the PHPDocumentator will use this
*  to automatically generate an API documentation using this information.
*
*  @author yourname
*/

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class Client {


    private $client;
    private $response;
    private $response_format = ConfigurationUnibet::JSON_RESPONSE;
    private $base_uri = ConfigurationUnibet::BASE_URI;
    private $app_key = ConfigurationUnibet::APP_KEY;
    private $app_id = ConfigurationUnibet::APP_ID;

    private $group_url = ConfigurationUnibet::GROUP_URL;
    private $event_url = ConfigurationUnibet::EVENT_URL;
    private $bets_url = ConfigurationUnibet::BETS_URL;
    private $supported_places_url = ConfigurationUnibet::SUPPORTED_SITES_URL;

    private $type_of_bet = ConfigurationUnibet::MATCH_BET;

    function __construct($config = [])
    {

        if (isset ($config['base_uri'])){
            $this->base_uri = $config['base_uri'];
        }

        if (isset ($config['app_key'])){
            $this->app_key = $config['app_key'];
        }

        if (isset ($config['app_id'])){
            $this->app_id = $config['app_id'];
        }

        if (isset ($config['type_of_bet'])){
            $this->type_of_bet = $config['type_of_bet'];
        }

        if (isset ($config['response'])){
            $this->type_of_bet = $config['response'];
        }

        $this->client = new GuzzleClient([
            'base_uri' => $this->base_uri,
        ]);
    }


    private function getDefaultArguments(){
        $arguments = [
            'app_id' => $this->app_id,
            'app_key' => $this->app_key
        ];

        return $arguments;
    }

    /********************* Private Methods *******************/

    private function sendRequest($url){

        try {
            $this->response = $this->client->request('GET', $url, ['query' => $this->getDefaultArguments()]);
        }catch (ClientException $e) {
            throw new NotFoundExceptionUnibet($e->getMessage());
        }
        catch (ServerException $e) {
            throw new NotFoundExceptionUnibet($e->getMessage());
        }
    }

    private function getContent(){
        $content = json_decode($this->response->getBody()->getContents(), true);

        return $content;
    }


    /********************* Public Methods *******************/

    public function getResponse(){
        return $this->response;
    }

    public function setResponseFormat($responseFormat){
        if ($responseFormat == ConfigurationUnibet::JSON_RESPONSE)
            $this->response_format = ConfigurationUnibet::JSON_RESPONSE;
        else if ($responseFormat == ConfigurationUnibet::XML_RESPONSE)
            $this->response_format = ConfigurationUnibet::JSON_RESPONSE;

        return $this;

    }

    public function getGroups(){

        $url = $this->group_url. $this->response_format;
        $this->sendRequest($url);

        return $this->getContent();

    }

    public function getEvents($events_id){

        $url = $this->event_url. $events_id .".". $this->response_format;
        $this->sendRequest($url);

        return $this->getContent();

    }

    public function getBets($event_id){

        $url = $this->bets_url. $event_id .".".$this->response_format;
        $this->sendRequest($url);

        return $this->getContent();

    }

    public function getSupportedPlaces(){

        $url = $this->supported_places_url . $this->response_format;
        $this->sendRequest($url);

        return $this->getContent();

    }

}
