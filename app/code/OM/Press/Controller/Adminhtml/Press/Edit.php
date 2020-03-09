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
 
class Edit extends Press
{
   /**
     * @return void
     */
    public function execute()
    {
        $pressId = $this->getRequest()->getParam('id');
        /** @var \OM\press\Model\press $model */
        $model = $this->_pressFactory->create();
        if ($pressId) {
            $model->load($pressId);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This press no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }
        $data = $this->_session->getpressData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_coreRegistry->register('press_press', $model);
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('OM_Press::main_menu');
        $resultPage->getConfig()->getTitle()->prepend(__('Press'));
        return $resultPage;
   }
}