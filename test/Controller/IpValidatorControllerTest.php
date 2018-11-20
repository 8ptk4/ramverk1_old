<?php

namespace Patrik\IpValidator;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Anax\Request\Request;

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
                    'ipAddressIpv4' => "172.16.254.1",
                    'ipAddressIpv6' => "2001:4860:4860::8844",
                ]
            ]
        );
    }



    /**
     * Test IPV4 Validation.
     * @method testValidationIpv4
     */
    public function testValidationIpv4()
    {
        $this->controller->ipAddress = $this->di->request->getPost('ipAddressIpv4');
        $this->controller->status = $this->controller->validateIp($this->controller->ipAddress);
        $this->controller->domain = $this->controller->getDomain($this->controller->ipAddress, $this->controller->status);
        $this->assertContains("IPV4", $this->controller->status);
        $this->assertInternalType('string', $this->controller->status);
    }



    /**
     * Test IPV6 Validation.
     * @method testValidationIpv6
     */
    public function testValidationIpv6()
    {
        $this->controller->ipAddress = $this->di->request->getPost('ipAddressIpv6');
        $this->controller->status = $this->controller->validateIp($this->controller->ipAddress);
        $this->assertContains("IPV6", $this->controller->status);
    }



    /**
     * Test IndexAction
     * @method testIndexAction.
     */
    public function testIndexAction()
    {
        $res = $this->controller->indexAction();
        $body = $res->getBody();
        $this->assertContains("| ramverk1", $body);
    }
}
