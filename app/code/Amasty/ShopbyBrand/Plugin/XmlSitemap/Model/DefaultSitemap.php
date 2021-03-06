<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2021 Amasty (https://www.amasty.com)
 * @package Amasty_ShopbyBrand
 */


declare(strict_types=1);

namespace Amasty\ShopbyBrand\Plugin\XmlSitemap\Model;

use Magento\Framework\DataObjectFactory as ObjectFactory;

/**
 * @deprecated remove after deprecating 2.2.x
 */
class DefaultSitemap
{
    /**
     * @var \Magento\Sitemap\Helper\Data
     */
    private $helper;

    /**
     * @var ObjectFactory
     */
    private $dataObjectFactory;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var \Magento\Eav\Model\Config
     */
    private $eavConfig;

    /**
     * @var \Amasty\ShopbyBase\Helper\OptionSetting
     */
    private $optionSetting;

    /**
     * @var \Amasty\ShopbyBrand\Model\XmlSitemap
     */
    private $xmlSitemap;

    /**
     * @var \Magento\Framework\Url
     */
    private $url;

    public function __construct(
        \Magento\Sitemap\Helper\Data $helper,
        ObjectFactory $dataObjectFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Eav\Model\Config $eavConfig,
        \Amasty\ShopbyBase\Helper\OptionSetting $optionSetting,
        \Amasty\ShopbyBrand\Model\XmlSitemap $xmlSitemap,
        \Magento\Framework\Url $url
    ) {
        $this->dataObjectFactory = $dataObjectFactory;
        $this->scopeConfig = $scopeConfig;
        $this->eavConfig = $eavConfig;
        $this->optionSetting = $optionSetting;
        $this->helper = $helper;
        $this->xmlSitemap = $xmlSitemap;
        $this->url = $url;
    }

    /**
     * @param \Magento\Sitemap\Model\Sitemap $subject
     * @return \Amasty\ShopbyBrand\Plugin\XmlSitemap\Model\DefaultSitemap
     */
    public function afterCollectSitemapItems(\Magento\Sitemap\Model\Sitemap $subject)
    {
        $result = $this->xmlSitemap->getBrandUrls($subject->getStoreId(), $this->url->getBaseUrl());

        if ($result) {
            $subject->addSitemapItem(new \Magento\Framework\DataObject(
                [
                    'changefreq' => $this->helper->getPageChangefreq($subject->getStoreId()),
                    'priority' => $this->helper->getPagePriority($subject->getStoreId()),
                    'collection' => $result,
                ]
            ));
        }

        return $this;
    }
}
