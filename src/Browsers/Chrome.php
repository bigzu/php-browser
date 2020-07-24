<?php
namespace Bigzu\Browsers;

use Bigzu\Slp\Browser;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class Chrome
{
    public DesiredCapabilities $desiredCapabilities;
    public ChromeOptions $options;

    public function __construct()
    {
        $this->desiredCapabilities = DesiredCapabilities::chrome();
        $this->options = new ChromeOptions();
    }

    public function withCapabilities(array $capabilities)
    {
        foreach($capabilities as $key => $value)
        {
            $this->desiredCapabilities->setCapability($key, $value);
        }

        return $this;
    }

    public function witArguments(array $arguments)
    {
        $this->options->addArguments($arguments);

        return $this;
    }

    public function setBinary($binary)
    {
        $this->options->setBinary($binary);

        return $this;
    }

    public function setExperimental(array $options)
    {
        foreach($options as $name => $value)
        {
            $this->options->setExperimentalOption($name, $value);
        }

        return $this;
    }

    public function create(): RemoteWebDriver
    {
        $this->desiredCapabilities->setCapability(ChromeOptions::CAPABILITY_W3C, $this->options);

        return Browser::open($this->desiredCapabilities);
    }
}
