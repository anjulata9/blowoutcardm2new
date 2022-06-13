<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2021 Amasty (https://www.amasty.com)
 * @package Amasty_GroupedOptions
 */


declare(strict_types=1);

namespace Amasty\GroupedOptions\Model\ResourceModel\GroupAttrOption;

use Amasty\GroupedOptions\Model\GroupAttrOption as GroupAttrOptionModel;
use Amasty\GroupedOptions\Model\ResourceModel\GroupAttrOption as GroupAttrOptionResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'group_option_id';

    protected function _construct()
    {
        $this->_init(GroupAttrOptionModel::class, GroupAttrOptionResource::class);
    }
}
