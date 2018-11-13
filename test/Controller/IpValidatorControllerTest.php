<?php

namespace Anax\Request;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Patrik\IpValidator\IpValidatorController;

/**
 * Test the IpValidatorController.
 */
class IpValidatorControllerTest extends TestCase
{

    // Create the di container.
    protected $di;
    protected $controller;



    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di = $this->di;
        $this->controller = new IpValidatorController();
        $this->controller->setDI($this->di);
        $di->request = new Request();
        $di->request->setGlobals(
            [
                'post' => [
                    'ipAdress' => "19.117.63.126",
                    'doSubmit' => true,
                ]
            ]
        );
    }



    /**
     * Test setIp should Equal getIp.
     */
    public function testSetGetIp()
    {
        $this->controller->setIp('19.117.63.126');
        $exp = '19.117.63.126';
        $this->assertEquals($exp, $this->controller->getIp());
    }



    /**
     * Test ValidateIPV4 adress returns a string.
     */
    public function testValidateIPV4()
    {
        $this->controller->setIp('85.227.176.120');
        $ipAdress = $this->controller->getIp();
        $this->controller->validateIp($ipAdress);
        $this->assertInternalType('string', $this->controller->status);
    }



    /**
     * Test ValidateIPV6 returns a string.
     */
    public function testValidateIPV6()
    {
        $this->controller->setIp('2001:db8:85a3::8a2e:370:7334');
        $ipAdress = $this->controller->getIp();
        $this->controller->validateIp($ipAdress);

        $this->assertInternalType('string', $this->controller->status);
    }



    /**
     * Test that a non ValidIp returns a string.
     */
    public function testValidateFail()
    {
        $this->controller->setIp('hej');
        $ipAdress = $this->controller->getIp();
        $this->controller->validateIp($ipAdress);
        $this->assertInternalType('string', $this->controller->status);
    }



    /**
     * Test so that post values is expected. And that submit is true.
     */
    public function testPostVariables()
    {
        $this->assertNotNull($this->di->request->getPost('doSubmit'));
        $this->controller->setIp($this->di->request->getPost('ipAdress'));

        $this->assertEquals($this->controller->ipAdress, $this->di->request->getPost('ipAdress'));
    }



    /**
     * Test the route "index".
     */
    public function testIpValidationIndexAction()
    {
        $res = $this->controller->indexAction();
        $this->assertInstanceOf("\Anax\Response\Response", $res);
        $body = $res->getBody();
        $exp = "| ramverk1</title>";
        $this->assertContains($exp, $body);
    }
}
