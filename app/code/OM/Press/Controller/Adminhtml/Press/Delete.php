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
 
class Delete extends Press
{
   /**
	* @return void
	*/
   public function execute()
   {
	    $pressId = (int) $this->getRequest()->getParam('id');
 
	    if ($pressId) {
		 /** @var $pressModel \OM\Press\Model\Press */
			$pressModel = $this->_pressFactory->create();
			$pressModel->load($pressId);
			if (!$pressModel->getId()) {
				$this->messageManager->addError(__('This press no longer exists.'));
			} else {
			    try {
				  $pressModel->delete();
				  $this->messageManager->addSuccess(__('The press has been deleted.'));
				  $this->_redirect('*/*/');
				  return;
			    } catch (\Exception $e) {
				   $this->messageManager->addError($e->getMessage());
				   $this->_redirect('*/*/edit', ['id' => $pressModel->getId()]);
			    }
			}
	    }
    }
}
 