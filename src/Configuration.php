<?php
namespace UnibetApiClient;
/**
 * Created by PhpStorm.
 * User: castor
 * Date: 23/02/2018
 * Time: 10:33
 */
class Configuration {

    const JSON_RESPONSE = 'json';
    const XML_RESPONSE = 'xml';

    const MATCH_BET = 0;
    const ALL_BET   = 1;

    const APP_KEY   = "";
    const APP_ID    = "";

    const BASE_URI  = "http://api.unicdn.net";
    const GROUP_URL = "/v1/feeds/sportsbook/groups.";
    const EVENT_URL = "/v1/feeds/sportsbook/event/group/";
    const BETS_URL  = "/v1/feeds//sportsbook/betoffer/event/";
    const SUPPORTED_SITES_URL  = "/v1/feeds/sportsbook/supported/sites.";

}
