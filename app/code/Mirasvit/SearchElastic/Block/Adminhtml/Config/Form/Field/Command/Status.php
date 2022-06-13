<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at https://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   mirasvit/module-search-ultimate
 * @version   2.0.36
 * @copyright Copyright (C) 2021 Mirasvit (https://mirasvit.com/)
 */


namespace Mirasvit\SearchElastic\Block\Adminhtml\Config\Form\Field\Command;

use Mirasvit\SearchElastic\Block\Adminhtml\Config\Form\Field\Command;

class Status extends Command
{
    /**
     * {@inheritdoc}
     */
    public function getAction()
    {
        return 'status';
    }
}
