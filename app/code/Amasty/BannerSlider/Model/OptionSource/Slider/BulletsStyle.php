<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2021 Amasty (https://www.amasty.com)
 * @package Amasty_BannerSlider
 */


declare(strict_types=1);

namespace Amasty\BannerSlider\Model\OptionSource\Slider;

use Magento\Framework\Option\ArrayInterface;

class BulletsStyle implements ArrayInterface
{
    const FIRST = 1;

    const SECOND = 2;

    const THIRD = 3;

    public function toOptionArray(): array
    {
        return [
            [
                'value' => self::FIRST,
                'label' => __('Morse')
            ],
            [
                'value' => self::SECOND,
                'label' => __('Line')
            ],
            [
                'value' => self::THIRD,
                'label' => __('Round')
            ]
        ];
    }
}
