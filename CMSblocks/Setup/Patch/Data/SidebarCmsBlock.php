<?php
/**
 * Seepossible
 * @package Seepossible_Newsletter
 * @copyright Copyright(C) 2015 Seepossible (contact@seepossible.com)
 * @author Seepossible <contact@seepossible.com>
 */
namespace Seepossible\CMSblocks\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Cms\Model\BlockFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class SidebarCmsBlock implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var BlockFactory
     */
    private $blockFactory;

    /**
     * Constructor
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param BlockFactory $blockFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        BlockFactory $blockFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->blockFactory = $blockFactory;
    }

    /**
     * Apply patch to create CMS block
     *
     * @return void
     * @throws LocalizedException
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $blockIdentifier = 'sidebar_cms_block';
        $blockTitle = 'Custom CMS Block Sidebar';
        
        // Load block by identifier to check if it already exists
        $cmsBlock = $this->blockFactory->create()->load($blockIdentifier, 'identifier');

        // Only create the block if it doesn't exist
        if (!$cmsBlock->getId()) {
            $cmsBlock->setData([
                'title' => $blockTitle,
                'identifier' => $blockIdentifier,
                'content' => '<p>This is additional content displayed Sidebar on the checkout page.</p>',
                'is_active' => 1,
                'stores' => [0]
            ])->save();
        }

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * Dependencies of the patch
     *
     * @return array
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * Aliases of the patch
     *
     * @return array
     */
    public function getAliases()
    {
        return [];
    }
}