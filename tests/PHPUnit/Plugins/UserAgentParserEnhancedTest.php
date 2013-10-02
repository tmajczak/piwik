<?php

require_once 'DevicesDetection/UserAgentParserEnhanced/UserAgentParserEnhanced.php';

class UserAgentParserEnhancedTest extends PHPUnit_Framework_TestCase
{
    public $fixtures;

    public function setUp()
    {
        $this->fixtures = Spyc::YAMLLoad(dirname(__FILE__) . '/userAgentParserEnhancedFixtures.yml');
    }

    public function testParse()
    {
        foreach ($this->fixtures as $userAgent => $data) {
            $userAgentParserEnhanced = new UserAgentParserEnhanced($userAgent);
            $userAgentParserEnhanced->parse();

            $this->assertEquals($data['os']['name'], $userAgentParserEnhanced->getOs('name'));
            $this->assertEquals($data['os']['short_name'], $userAgentParserEnhanced->getOs('short_name'));
            $this->assertEquals($data['os']['version'], $userAgentParserEnhanced->getOs('version'));

            $this->assertEquals($data['browser']['name'], $userAgentParserEnhanced->getBrowser('name'));
            $this->assertEquals($data['browser']['short_name'], $userAgentParserEnhanced->getBrowser('short_name'));
            $this->assertEquals($data['browser']['version'], $userAgentParserEnhanced->getBrowser('version'));

            $this->assertEquals($data['device'], $userAgentParserEnhanced->getDevice());
            $this->assertEquals($data['brand'], $userAgentParserEnhanced->getBrand());
            $this->assertEquals($data['brand'], $userAgentParserEnhanced->getBrand());
            $this->assertEquals($data['model'], $userAgentParserEnhanced->getModel());

            $this->assertEquals($data['os_family'], $userAgentParserEnhanced->getOsFamily($userAgentParserEnhanced->getOs('name')));
            $this->assertEquals($data['browser_family'], $userAgentParserEnhanced->getBrowserFamily($userAgentParserEnhanced->getBrowser('name')));
        }
    }
}
