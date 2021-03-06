<?php
/**
 * Aheadworks Inc.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://ecommerce.aheadworks.com/end-user-license-agreement/
 *
 * @package    Acr
 * @version    1.1.2
 * @copyright  Copyright (c) 2020 Aheadworks Inc. (http://www.aheadworks.com)
 * @license    https://ecommerce.aheadworks.com/end-user-license-agreement/
 */
namespace Aheadworks\Acr\Model\ResourceModel\Rule\Relation\Coupon;

use Aheadworks\Acr\Api\Data\CouponRuleInterface;
use Aheadworks\Acr\Api\Data\RuleInterface;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\EntityManager\Operation\ExtensionInterface;

/**
 * Class SaveHandler
 * @package Aheadworks\Acr\Model\ResourceModel\Rule\Relation\Coupon
 * @codeCoverageIgnore
 */
class SaveHandler implements ExtensionInterface
{
    /**
     * @var ResourceConnection
     */
    private $resourceConnection;

    /**
     * @var MetadataPool
     */
    private $metadataPool;

    /**
     * @var DataObjectProcessor
     */
    private $dataObjectProcessor;

    /**
     * @param MetadataPool $metadataPool
     * @param ResourceConnection $resourceConnection
     * @param DataObjectProcessor $dataObjectProcessor
     */
    public function __construct(
        MetadataPool $metadataPool,
        ResourceConnection $resourceConnection,
        DataObjectProcessor $dataObjectProcessor
    ) {
        $this->resourceConnection = $resourceConnection;
        $this->metadataPool = $metadataPool;
        $this->dataObjectProcessor = $dataObjectProcessor;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function execute($entity, $arguments = [])
    {
        $entityId = (int)$entity->getId();

        /** @var CouponRuleInterface|null $couponRuleDataObject */
        $couponRuleDataObject = $entity->getCouponRule();
        if ($couponRuleDataObject) {
            $connection = $this->getConnection();
            $tableName = $this->resourceConnection->getTableName('aw_acr_rule_coupon');
            $connection->delete(
                $tableName,
                ['rule_id = ?' => $entityId]
            );

            if ($couponRuleDataObject->getSalesRuleId()) {
                $couponRuleDataObject->setRuleId($entityId);
                $couponRuleData = $this->dataObjectProcessor->buildOutputDataArray(
                    $couponRuleDataObject,
                    CouponRuleInterface::class
                );
                $connection->insert($tableName, $couponRuleData);
            }
        }
        return $entity;
    }

    /**
     * Get connection
     *
     * @return \Magento\Framework\DB\Adapter\AdapterInterface
     * @throws \Exception
     */
    private function getConnection()
    {
        return $this->resourceConnection->getConnectionByName(
            $this->metadataPool->getMetadata(RuleInterface::class)->getEntityConnectionName()
        );
    }
}
