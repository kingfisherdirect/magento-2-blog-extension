<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_Blog
 * @copyright   Copyright (c) 2017 Mageplaza (http://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

namespace Mageplaza\Blog\Controller\Adminhtml\Comment;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Mageplaza\Blog\Model\ResourceModel\Comment\CollectionFactory;

/**
 * Class MassDelete
 * @package Mageplaza\Blog\Controller\Adminhtml\Comment
 */
class MassDelete extends Action
{
    /**
     * Mass Action Filter
     *
     * @var \Magento\Ui\Component\MassAction\Filter
     */
    public $filter;

    /**
     * @var \Mageplaza\Blog\Model\ResourceModel\Comment\CollectionFactory
     */
    public $collectionFactory;

    /**
     * MassDelete constructor.
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory
    )
    {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * @return $this|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {

//        try {
////            \Zend_Debug::dump($this->getRequest()->getParam('selected'));die();
//            $deleteIds = $this->getRequest()->getParams('selected');
//            $collection = $this->collectionFactory->create();
//            $collection->addFieldToFilter('comment_id', array('in' => $deleteIds));
//            $count = 0;
//            foreach ($collection as $item){
//                $item->delete();
//                $count++;
//            }
//            $this->messageManager->addSuccessMessage(__('Total of %1 comments has been deleted.',$count));
//        } catch (\Exception $e) {
//            $this->messageManager->addErrorMessage(__('Something wrong when delete Comments.'));
//        }
//
//        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
//        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
//
//        return $resultRedirect->setPath('*/*/');

        $collection = $this->filter->getCollection($this->collectionFactory->create());

        try {
            $count = 0;
            foreach ($collection as $item){
                $item->delete();
                $count++;
            }
            $this->messageManager->addSuccessMessage(__('Total of %1 comments has been deleted.',$count));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Something wrong when delete Comments.'));
        }

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        return $resultRedirect->setPath('*/*/');
    }
}
