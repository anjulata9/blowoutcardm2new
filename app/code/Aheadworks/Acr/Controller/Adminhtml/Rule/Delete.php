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
namespace Aheadworks\Acr\Controller\Adminhtml\Rule;

use Aheadworks\Acr\Api\RuleRepositoryInterface;
use Magento\Backend\App\Action\Context;

/**
 * Class Delete
 * @package Aheadworks\Acr\Controller\Adminhtml\Rule
 */
class Delete extends \Magento\Backend\App\Action
{
    /**
     * {@inheritdoc}
     */
    const ADMIN_RESOURCE = 'Aheadworks_Acr::rules';

    /**
     * @var RuleRepositoryInterface
     */
    private $ruleRepository;

    /**
     * @param Context $context
     * @param RuleRepositoryInterface $ruleRepository
     */
    public function __construct(
        Context $context,
        RuleRepositoryInterface $ruleRepository
    ) {
        parent::__construct($context);
        $this->ruleRepository = $ruleRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $ruleId = (int)$this->getRequest()->getParam('id');
        if ($ruleId) {
            try {
                $this->ruleRepository->deleteById($ruleId);
                $this->messageManager->addSuccessMessage(__('Rule was successfully deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $exception) {
                $this->messageManager->addErrorMessage($exception->getMessage());
            }
        }
        $this->messageManager->addErrorMessage(__('Rule could not be deleted.'));
        return $resultRedirect->setPath('*/*/');
    }
}
