<?php
/**
 * Seepossible
 * @package Seepossible_Demo
 * @copyright Copyright(C) 2015 Seepossible (contact@seepossible.com)
 * @author Seepossible <contact@seepossible.com>
 */

namespace Seepossible\Demo\Model\ResourceModel\Demo;
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'demo_id';
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'Seepossible\Demo\Model\Demo',
            'Seepossible\Demo\Model\ResourceModel\Demo'
        );
    }
}