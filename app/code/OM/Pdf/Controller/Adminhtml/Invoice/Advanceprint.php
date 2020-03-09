<?php

namespace OM\Pdf\Controller\Adminhtml\Invoice;

class Advanceprint extends \Magento\Backend\App\Action
{


    protected $resultPageFactory;
   
    /**
    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context  $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\App\Request\Http $request
     
        
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->request = $request;
        parent::__construct($context);
    }


    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
       $resultPageLayout = $this->resultPageFactory->create();
       $resultPageLayout->getLayout()->getUpdate()->removeHandle('default');
       return $resultPageLayout;
    }
}
