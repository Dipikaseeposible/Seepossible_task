<?php
/**
 * Seepossible
 * @package Seepossible_Sortby
 * @copyright Copyright(C) 2015 Seepossible (contact@seepossible.com)
 * @author Seepossible <contact@seepossible.com>
 */
namespace Seepossible\Sortby\Plugin\Model;
use Magento\Store\Model\StoreManagerInterface;
class Config
{
    protected $_storeManager;
    public function __construct(
        StoreManagerInterface $storeManager
    )
    {
        $this->_storeManager = $storeManager;
    }
    public function afterGetAttributeUsedForSortByArray(\Magento\Catalog\Model\Config $catalogConfig, $options)
    {
        $customOption['newest_product'] = __('New products');
        $options = array_merge($customOption, $options);
        return $options;
    }
}