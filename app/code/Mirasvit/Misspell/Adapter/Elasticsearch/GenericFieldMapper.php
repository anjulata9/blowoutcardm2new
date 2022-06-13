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



declare(strict_types=1);

namespace Mirasvit\Misspell\Adapter\Elasticsearch;

use Magento\Elasticsearch\Model\Adapter\FieldMapperInterface as FieldMapperInterface;

class GenericFieldMapper implements FieldMapperInterface
{
    private $attributeTypes = [
        'keyword'   => [
            'type' => 'text',
            'fields' => [
                'trigram' => [
                    'type' => 'text',
                    'analyzer' => 'trigram'
                ],
                'reverse' => [
                    'type' => 'text',
                    'analyzer' => 'reverse'
                ],
            ],
        ],
        'trigram'   => [
            'type' => 'text'
        ],
        'frequency' => [
            'type' => 'text'
        ],
    ];

    public function getAllAttributesTypes($context = [])
    {
        return $this->attributeTypes;
    }

    public function getFieldName($attributeCode, $context = [])
    {
        throw new \LogicException('Not implemented');
    }
}
