<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Framework\Stdlib\Test\Unit\DateTime;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Stdlib\DateTime\GetDateTimeFormatFromConfig;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;

class GetDateTimeFormatFromConfigTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var \Magento\Framework\Locale\ResolverInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    protected $localeResolverMock;

    /**
     * SetUp Method for GetDateTimeFormatFromConfigTest
     */
    protected function setUp()
    {
        if (defined('HHVM_VERSION')) {
            $this->markTestSkipped('Skip this test for hhvm due to problem with \IntlDateFormatter::formatObject');
        }

        $this->objectManager = new ObjectManager($this);
    }

    public function dataProviderDateTimeFormat()
    {
        /** returns [$dateTimeFormat, $scopeType, $configPath] */
        return [
            ['dd.MM.YYYY H:mm:ss', 'stores', 'general/locale/date_time_format'],
            [null, 'stores', 'general/locale/date_time_format']
        ];
    }

    /**
     * @param $dateTimeFormat
     * @param $scopeType
     * @param $configPath
     *
     * @dataProvider dataProviderDateTimeFormat
     */
    public function testExecuteWillReturnFormat($dateTimeFormat, $scopeType, $configPath)
    {
        $scopeConfig = $this->getScopeConfigMock();
        $scopeConfig
            ->expects($this->once())
            ->method('getValue')
            ->with($configPath, $scopeType, null)
            ->willReturn($dateTimeFormat);

        $arguments = [
            'scopeConfig'               => $scopeConfig,
            'scopeType'                 => $scopeType,
            'defaultDatetimeFormatPath' => $configPath
        ];

        $testInstance = $this->getInstanceOfGetDateTimeFromConfig($arguments);
        $this->assertEquals($dateTimeFormat, $testInstance->execute());
    }

    // ------------------------------------------------------------------
    // The following Methods Instanciates Objects, this is just easier to Mock when you need to and when we need twice
    // of one Object we just can get another. It also makes it easier to manipulate the Methods
    // ------------------------------------------------------------------

    /**
     * @param array $arguments
     *
     * @return GetDateTimeFormatFromConfig | object
     */
    public function getInstanceOfGetDateTimeFromConfig($arguments = [])
    {
        return $this->objectManager->getObject(GetDateTimeFormatFromConfig::class, $arguments);
    }

    /**
     * @return ScopeConfigInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    public function getScopeConfigMock()
    {
        return $this->getMockForAbstractClass(ScopeConfigInterface::class);
    }
}
