<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\Stdlib\DateTime;

use Magento\Framework\App\Config\ScopeConfigInterface;

class GetDateTimeFormatFromConfig implements GetDateTimeFormatFromConfigInterface
{

    /**
     * @var ScopeConfigInterface
     */
    private $_scopeConfig;
    /**
     * @var string
     */
    private $defaultDatetimeFormatPath;
    /**
     * @var string
     */
    private $scopeType;

    /**
     * GetDateTimeFormatFromConfig constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     * @param string $scopeType
     * @param string $defaultDatetimeFormatPath
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        $scopeType,
        $defaultDatetimeFormatPath
    ) {
        $this->_scopeConfig = $scopeConfig;
        $this->defaultDatetimeFormatPath = $defaultDatetimeFormatPath;
        $this->scopeType = $scopeType;
    }

    /**
     * @inheritdoc
     */
    public function execute($scopeType = null, $scopeCode = null)
    {
        return $this->_scopeConfig->getValue(
            $this->getDefaultDatetimeFormatPath(),
            $scopeType ?: $this->scopeType,
            $scopeCode
        );
    }

    /**
     * @inheritdoc
     */
    public function getDefaultDatetimeFormatPath()
    {
        return $this->defaultDatetimeFormatPath;
    }
}
