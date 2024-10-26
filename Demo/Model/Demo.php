<?php
/**
 * Seepossible
 * @package Seepossible_Demo
 * @copyright Copyright(C) 2015 Seepossible (contact@seepossible.com)
 * @author Seepossible <contact@seepossible.com>
 */

namespace Seepossible\Demo\Model;

use Magento\Framework\Model\AbstractModel;

class Demo extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('Seepossible\Demo\Model\ResourceModel\Demo');
    }
}