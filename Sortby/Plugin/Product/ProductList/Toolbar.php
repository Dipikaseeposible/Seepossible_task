<?php
/**
 * Seepossible
 * @package Seepossible_Sortby
 * @copyright Copyright(C) 2015 Seepossible (contact@seepossible.com)
 * @author Seepossible <contact@seepossible.com>
 */

namespace Seepossible\Sortby\Plugin\Product\ProductList;

use Magento\Catalog\Block\Product\ProductList\Toolbar as Productdata;

class Toolbar
{
    public function aroundSetCollection(Productdata $subject, \Closure $proceed, $collection)
    {
        $currentOrder = $subject->getCurrentOrder();
        if ($currentOrder) {
            if ($currentOrder == "newest_product") {
                $direction = $subject->getCurrentDirection();
                $collection->getSelect()->order('created_at ' . $direction);
            }
            return $proceed($collection);
        }
    }
}