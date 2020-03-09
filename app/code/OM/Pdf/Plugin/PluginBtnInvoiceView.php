<?php
namespace OM\Pdf\Plugin;

use Magento\Backend\Model\UrlInterface;
use Magento\Framework\ObjectManagerInterface;

class PluginBtnInvoiceView
{
    protected $object_manager;
    protected $_backendUrl;
    protected $_request;

    public function __construct(
        ObjectManagerInterface $om,
        UrlInterface $backendUrl,
         \Magento\Framework\App\RequestInterface $request
    ) {
        $this->object_manager = $om;
        $this->_backendUrl = $backendUrl;
        $this->_request = $request;
    }

    public function beforeSetLayout(\Magento\Sales\Block\Adminhtml\Order\Invoice\View $subject )
    {
        $invoiceId = $this->_request->getParam('invoice_id');
       
        $sendOrder = $this->_backendUrl->getUrl('advancepdf/invoice/advanceprint/invoice_id/'.$invoiceId);
        $subject->addButton(
            'advancepdf',
            [
                'label' => __('Print Advance Invoice'),
                'onclick' => "setLocation('" . $sendOrder. "')",
                'class' => 'ship primary'
            ]
        );

        return null;
    }

}