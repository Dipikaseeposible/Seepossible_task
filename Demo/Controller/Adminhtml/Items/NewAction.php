<?php
/**
 * Seepossible
 * @package Seepossible_Demo
 * @copyright Copyright(C) 2015 Seepossible (contact@seepossible.com)
 * @author Seepossible <contact@seepossible.com>
 */

namespace Seepossible\Demo\Controller\Adminhtml\Items;

class NewAction extends \Seepossible\Demo\Controller\Adminhtml\Items
{

    public function execute()
    {
        $this->_forward('edit');
    }
}
