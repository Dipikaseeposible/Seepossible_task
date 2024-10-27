<?php
/**
 * Seepossible
 * @package Seepossible_Demo
 * @copyright Copyright(C) 2015 Seepossible (contact@seepossible.com)
 * @author Seepossible <contact@seepossible.com>
 */

namespace Seepossible\Demo\Controller\Adminhtml\Items;

use Magento\Backend\App\Action;
use Seepossible\Demo\Model\Demo;
use Magento\Backend\Model\Session;
use Psr\Log\LoggerInterface;
use Magento\Framework\Message\ManagerInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;



class Save extends Action
{
    protected $model;
    protected $session;
    protected $logger;
    protected $messageManager;
    protected $productRepository;

    public function __construct(
        Action\Context $context,
        Demo $model,
        Session $session,
        LoggerInterface $logger,
        ManagerInterface $messageManager,
        ProductRepositoryInterface $productRepository
    ) {
        parent::__construct($context);
        $this->model = $model;
        $this->session = $session;
        $this->logger = $logger;
        $this->messageManager = $messageManager;
        $this->productRepository = $productRepository;
    }

    public function execute()
    {
        if ($this->getRequest()->getPostValue()) {
            try {
                $data = $this->getRequest()->getPostValue();
                $id = $this->getRequest()->getParam('id');
                if ($id) {
                    $this->model->load($id);
                    if ($id != $this->model->getId()) {
                        throw new LocalizedException(__('The wrong item is specified.'));
                    }
                }
                $this->model->setData($data);
                $this->session->setPageData($this->model->getData());
                $this->model->save();
                $this->messageManager->addSuccessMessage(__('You saved the item.'));
                $this->session->setPageData(false);
                $block_id = $this->model->getId();
                $sp_blog_data = $data['selected_product_ids'];
                if ($sp_blog_data) {
                    $spdata = explode(",", $sp_blog_data);
                    foreach ($spdata as $productId) {
                        $product = $this->productRepository->getById($productId);
                        $existingBlocks = $product->getData('sp_blog_id') ? explode(",", $product->getData('sp_blog_id')) : [];
                        if (!in_array($block_id, $existingBlocks)) {
                            $existingBlocks[] = $block_id;
                        }
                        $product->setData('sp_blog_id', implode(",", $existingBlocks));
                        $this->productRepository->save($product);
                    }
                }
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('Seepossible_demo/*/edit', ['id' => $this->model->getId()]);
                    return;
                }
                $this->_redirect('Seepossible_demo/*/');
                return;
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                $id = (int)$this->getRequest()->getParam('id');
                if (!empty($id)) {
                    $this->_redirect('Seepossible_demo/*/edit', ['id' => $id]);
                } else {
                    $this->_redirect('Seepossible_demo/*/new');
                }
                return;
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(
                    __('Something went wrong while saving the item data. Please review the error log.')
                );
                $this->logger->critical($e);
                $this->session->setPageData($data);
                $this->_redirect('Seepossible_demo/*/edit', ['id' => $this->getRequest()->getParam('id')]);
                return;
            }
        }
        $this->_redirect('Seepossible_demo/*/');
    }
}
