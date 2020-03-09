<?php
/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace FME\Faqs\Controller\Adminhtml\Topic;

use Magento\Backend\App\Action;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
        
    ) {
         
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('FME_Faqs::topic');
    }

    /**
     * Init actions
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('FME_Faqs::topic')
            ->addBreadcrumb(__('Topic'), __('Topic'))
            ->addBreadcrumb(__('Manage Topic'), __('Manage Topic'));
        return $resultPage;
    }

    /**
     * Edit CMS page
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('faqs_topic_id');
        $model = $this->_objectManager->create('FME\Faqs\Model\Topic');

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This record no longer exists.'));
                /** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }


        // 3. Set entered data if was error when we do save
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);


               
           

       // $temp = $model->getData();


         //$img = [];
          //      $img[0]['name'] = $temp['image'];
           //     $img[0]['url'] = 'http://localhost/m22/pub/media//faqs/j1_1.jpg';
            //    $temp['image'] = $img;
        
       //  $model->setData($temp);
       //  print_r($model->getData());
       // exit;

        if (!empty($data)) {
            $model->setData($data);
        }
       // print_r($model->getData());
      //  exit;
        // 4. Register model to use later in blocks
        $this->_coreRegistry->register('topic', $model);
        
        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit Topic') : __('New Topic'),
            $id ? __('Edit Topic') : __('New Topic')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Topic'));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? __('Edit "%1"', $model->getTitle()) : __('New Topic'));
        
        return $resultPage;
    }
}