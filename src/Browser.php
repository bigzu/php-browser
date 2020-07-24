<?php


namespace Bigzu\Slp;


use Bigzu\Browsers\Chrome;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class Browser
{
    public static string $host;

    public static function open(DesiredCapabilities $desiredCapabilities): RemoteWebDriver
    {
        return RemoteWebDriver::create(self::$host, $desiredCapabilities);
    }

    public function close($session_id)
    {
        RemoteWebDriver::createBySessionID($session_id)->close()->quit();
    }

    public function chrome($host = "http://localhost:4444/wd/hub")
    {
        self::$host = $host;
        return new Chrome();
    }
}
