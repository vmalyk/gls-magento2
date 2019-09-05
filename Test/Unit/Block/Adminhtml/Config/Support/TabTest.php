<?php
/**
 *
 *          ..::..
 *     ..::::::::::::..
 *   ::'''''':''::'''''::
 *   ::..  ..:  :  ....::
 *   ::::  :::  :  :   ::
 *   ::::  :::  :  ''' ::
 *   ::::..:::..::.....::
 *     ''::::::::::::''
 *          ''::''
 *
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Creative Commons License.
 * It is available through the world-wide-web at this URL:
 * http://creativecommons.org/licenses/by-nc-nd/3.0/nl/deed.en_US
 * If you are unable to obtain it through the world-wide-web, please send an email
 * to servicedesk@tig.nl so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this module to newer
 * versions in the future. If you wish to customize this module for your
 * needs please contact servicedesk@tig.nl for more information.
 *
 * @copyright   Copyright (c) Total Internet Group B.V. https://tig.nl/copyright
 * @license     http://creativecommons.org/licenses/by-nc-nd/3.0/nl/deed.en_US
 */
namespace TIG\GLS\Test\Unit\Block\Adminhtml\Config\Support;

use TIG\GLS\Block\Adminhtml\Config\Support\Tab;
use TIG\GLS\Test\TestCase;

class TabTest extends TestCase
{
    protected $instanceClass = Tab::class;

    public function testGetVersionNumber()
    {
        $object = $this->getObject(\TIG\GLS\Service\Software\Data::class);

        $instance = $this->getInstance(['softwareData' => $object]);
        $this->assertSame('1.0.0', $instance->getVersionNumber());
    }

    public function testGetSupportedMagentoVersions()
    {
        $instance = $this->getInstance([
           'supportTab' => $this->getConfigurationMock()
        ]);

        $this->assertSame('2.2.0 - 2.2.9, 2.3.0 - 2.3.2', $instance->getSupportedMagentoVersions());
    }

    /**+
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getConfigurationMock()
    {
        $mock = $this->getFakeMock(\TIG\GLS\Model\Config\Provider\Support\Tab::class)->getMock();
        $mockExpects = $mock->expects($this->once());
        $mockExpects->method('getSupportedMagentoVersions');
        $mockExpects->willReturn('2.2.0 - 2.2.9, 2.3.0 - 2.3.2');

        return $mock;
    }
}
