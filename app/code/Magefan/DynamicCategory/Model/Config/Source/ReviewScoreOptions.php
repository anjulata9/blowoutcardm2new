<?php
/**
 * Copyright © Magefan (support@magefan.com). All rights reserved.
 * Please visit Magefan.com for license details (https://magefan.com/end-user-license-agreement).
 */

namespace Magefan\DynamicCategory\Model\Config\Source;

class ReviewScoreOptions extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * @return array
     */
    public function getAllOptions()
    {
            $this->_options = [
                ['label' => '★☆☆☆☆', 'value' => 1],
                ['label' => '★★☆☆☆', 'value' => 2],
                ['label' => '★★★☆☆', 'value' => 3],
                ['label' => '★★★★☆', 'value' => 4],
                ['label' => '★★★★★', 'value' => 5]
            ];
            return $this->_options;
    }

    public function getOptionText($value)
    {
        foreach ($this->getAllOptions() as $option) {
            if ($option['value'] == $value) {
                return $option['label'];
            }
        }
        return false;
    }
}
