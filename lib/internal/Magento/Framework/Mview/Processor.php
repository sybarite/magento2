<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Magento\Framework\Mview;

class Processor implements ProcessorInterface
{
    /**
     * @var View\CollectionFactory
     */
    protected $viewsFactory;

    /**
     * @param View\CollectionFactory $viewsFactory
     */
    public function __construct(View\CollectionFactory $viewsFactory)
    {
        $this->viewsFactory = $viewsFactory;
    }

    /**
     * Return list of views by group
     *
     * @param string $group
     * @return ViewInterface[]
     */
    protected function getViewsByGroup($group = '')
    {
        $collection = $this->viewsFactory->create();
        return $group ? $collection->getItemsByColumnValue('group', $group) : $collection->getItems();
    }

    /**
     * Materialize all views by group (all views if empty)
     *
     * @param string $group
     * @return void
     */
    public function update($group = '')
    {
        foreach ($this->getViewsByGroup($group) as $view) {
            $view->update();
        }
    }

    /**
     * Clear all views' changelogs by group (all views if empty)
     *
     * @param string $group
     * @return void
     */
    public function clearChangelog($group = '')
    {
        foreach ($this->getViewsByGroup($group) as $view) {
            $view->clearChangelog();
        }
    }
}
