<?php 
/**
 * OrangeMantra.
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    OrangeMantra
 * @package     OM_Press
 * @author      Shiv Kr Maurya (Senior Magento Developer)
 * @copyright   Copyright (c) 2017 OrangeMantra
 */
namespace OM\Press\Controller\Adminhtml\Press;
use OM\Press\Controller\Adminhtml\Press; 

class Index extends Press
{
    /**
     * @return void
     */
    public function execute()
    {
      if ($this->getRequest()->getQuery('ajax')) {
        $this->_forward('grid');
        return;
      }
      /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
      $resultPage = $this->_resultPageFactory->create();
      $resultPage->setActiveMenu('OM_Press::main_menu');
      $resultPage->getConfig()->getTitle()->prepend(__('Press'));
      return $resultPage;
   }
}

