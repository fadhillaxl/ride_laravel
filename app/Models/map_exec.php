<?php
// header('Content-Type: application/json');

require_once __DIR__ . '/../../vendor/autoload.php';

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverKeys;
use Facebook\WebDriver\WebDriverExpectedCondition;

class GoogleMapsSearcher
{
    private $driver;

    public function __construct()
    {
        $host = 'http://localhost:9515';
        $chromeOptions = new ChromeOptions();
        $chromeOptions->addArguments(['--headless']);
        $capabilities = DesiredCapabilities::chrome();
        $capabilities->setCapability(ChromeOptions::CAPABILITY, $chromeOptions);
        $this->driver = RemoteWebDriver::create($host, $capabilities, 60000, 60000);
    }

    public function search($place)
    {
        try {
            $this->navigateToGoogleMaps();
            $this->enterSearchQuery($place);
            return $this->fetchSuggestions();
        } finally {
            $this->driver->quit();
        }
    }

    private function navigateToGoogleMaps()
    {
        $this->driver->get('https://www.google.com/maps?hl=id');
        $this->driver->wait(10, 500)->until(
            WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id('searchboxinput'))
        );
    }

    private function enterSearchQuery($place)
    {
        $searchBox = $this->driver->findElement(WebDriverBy::id('searchboxinput'));
        $searchBox->sendKeys($place);
        $this->driver->wait(10, 500)->until(
            WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector('[jsaction="suggestion.select"]'))
        );
    }

    private function fetchSuggestions()
    {
        $suggestions = $this->driver->findElements(WebDriverBy::cssSelector('[jsaction="suggestion.select"]'));
        $suggestionsArray = [];
        foreach ($suggestions as $suggestion) {
            $nameElement = $suggestion->findElement(WebDriverBy::cssSelector('.cGyruf.fontBodyMedium.RYaupb'));
            $addressElement = $suggestion->findElement(WebDriverBy::cssSelector('.EmLCAe.fontBodyMedium'));
            $suggestionsArray[] = [
                'name' => $nameElement->getText(),
                'address' => $addressElement->getText()
            ];
        }
        return $suggestionsArray;
    }
}

// CLI handling
if (php_sapi_name() === 'cli') {
    if (isset($argv[1])) {
        $searcher = new GoogleMapsSearcher();
        $data = $searcher->search($argv[1]);
        $res = [
            'data' => $data,
            'status' => 200
        ];
        echo json_encode($res);
    } else {
        echo "Please provide a place name as an argument.\n";
    }
}

