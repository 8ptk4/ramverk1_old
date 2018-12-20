<?php

namespace Patrik\Models;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;
use Patrik\Models\Ipstack;
use Anax\Request\Request;

/**
 * Test the IpValidatorController.
 */
class IpValidatorControllerTest extends TestCase
{


    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di = $this->di;


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
        $this->controller = new IpValidator($this->di->request->getPost('ipAddressIpv4'));
        $this->controller->setDI($this->di);
        $this->controller->ipAddress = $this->di->request->getPost('ipAddressIpv4');
        $this->controller->status = $this->controller->validate($this->di->request->getPost('ipAddressIpv4'));
        $this->controller->domain = $this->controller->getDomain();
        $this->assertContains("IPV4", $this->controller->status);
        $this->assertInternalType('string', $this->controller->status);
    }



    /**
     * Test IPV6 Validation.
     * @method testValidationIpv6
     */
    public function testValidationIpv6()
    {
        $this->controller = new IpValidator($this->di->request->getPost('ipAddressIpv6'));
        $this->controller->setDI($this->di);
        $this->controller->ipAddress = $this->di->request->getPost('ipAddressIpv6');
        $this->controller->status = $this->controller->validate($this->di->request->getPost('ipAddressIpv6'));
        $this->controller->domain = $this->controller->getDomain();
        $this->assertContains("IPV6", $this->controller->status);
        $this->assertInternalType('string', $this->controller->status);
    }
}
