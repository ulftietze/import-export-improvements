<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\Stdlib\DateTime;

/**
 * @api
 */
interface GetDateTimeFormatFromConfigInterface
{
    /**
     * @param string $scopeType
     * @param string $scopeCode
     * @return string | null
     */
    public function execute($scopeType = null, $scopeCode = null);

    /**
     * @return string
     */
    public function getDefaultDatetimeFormatPath();
}
