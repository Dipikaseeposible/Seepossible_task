<?php
/**
 * Seepossible
 * @package Seepossible_Demo
 * @copyright Copyright(C) 2015 Seepossible (contact@seepossible.com)
 * @author Seepossible <contact@seepossible.com>
 */

namespace Seepossible\Demo\Controller\Adminhtml\Items;

class Index extends \Seepossible\Demo\Controller\Adminhtml\Items
{
    /**
     * Items list.
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Seepossible_Demo::test');
        $resultPage->getConfig()->getTitle()->prepend(__('Blog Items'));
        $resultPage->addBreadcrumb(__('Blog'), __('Blog'));
        $resultPage->addBreadcrumb(__('Blog'), __('Blog'));
        return $resultPage;
    }
}