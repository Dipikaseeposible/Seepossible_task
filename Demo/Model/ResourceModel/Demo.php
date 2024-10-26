<?php
/**
 * Seepossible
 * @package Seepossible_Demo
 * @copyright Copyright(C) 2015 Seepossible (contact@seepossible.com)
 * @author Seepossible <contact@seepossible.com>
 */

namespace Seepossible\Demo\Model\ResourceModel;

class Demo extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('sp_blog', 'demo_id');   //here "sp_blog" is table name and "demo_id" is the primary key of custom table
    }
}