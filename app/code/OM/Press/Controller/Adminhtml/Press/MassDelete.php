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
 
class MassDelete extends Press
{
   /**
    * @return void
    */
   public function execute()
   {
      $pressIds = $this->getRequest()->getParam('press');
      foreach ($pressIds as $pressId) {
        try {
           /** @var $pressModel \OM\press\Model\press */
            $pressModel = $this->_pressFactory->create();
            $pressModel->load($pressId)->delete();
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }
      }
      if (count($pressIds)) {
          $this->messageManager->addSuccess(
              __('A total of %1 record(s) were deleted.', count($pressIds))
          );
      }
      $this->_redirect('*/*/index');
   }
}