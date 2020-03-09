<?php


namespace OM\Pdf\Block\Adminhtml\Index;

class Index extends \Magento\Backend\Block\Template
{

    /**
     * Constructor
     *
     * @param \Magento\Backend\Block\Template\Context  $context
     * @param array $data
     */
    
    /*    
    
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }
    
    */
    /*
     * Sales Factory
     * @var \Magento\Sales\Model\OrderFactory
     */
    protected $_orderFactory;

    /**
     * Order Address
     * @var \Magento\Sales\Model\Order\Address\Renderer
     */
    protected $render;

    /**
     * Pricing Helper Data
     * @var \Magento\Framework\Pricing\Helper\Data
     */
    protected $formatPrice;

    protected $request;

    protected $objectManager;

    protected $timezoneInterface;


    public function __construct(        
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magento\Backend\Block\Template\Context $context,        
        \Magento\Sales\Model\Order\Address\Renderer $render,
        \Magento\Framework\Pricing\Helper\Data $formatPrice,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\ObjectManagerInterface $objectmanager,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezoneInterface,
        array $data = []
    ) {
        parent::__construct($context, $data);  
        $this->_orderFactory = $orderFactory;
        $this->objectManager = $objectmanager;
        $this->render = $render;
        $this->formatPrice = $formatPrice;
        $this->request = $request;
        $this->timezoneInterface = $timezoneInterface;
    }

    

    public function getParams()
    {
        return $this->request->getParams();
    }

    /**
     * Format Price
     *
     * @param float $value
     * @return float
     */
    public function formatPrice($value)
    {
        return $this->formatPrice->currency($value, true, false);
    }

    /**
     * Get Re-Order
     * @return string
     */
   

    /**
     * Format Shipping Address
     * @return string
     */
    public function formatShipping($order)
    {
        
        if ($order->getShippingAddress()) {
            return strip_tags($this->render->format($order->getShippingAddress(), 'html'));
        }
            return false;
    } 



    /**
     * Format Billing Address
     * @return string
     */
    public function formatBilling($order)
    {            
            return strip_tags($this->render->format($order->getBillingAddress(), 'html'));
    }


    public function getInvoice($id)
    {
        
        $invoice = $this->objectManager->create('Magento\Sales\Model\Order\Invoice')->load($id);
        return $invoice;
    }

     public function getHsnCode($id)
    {
        
        $product = $this->objectManager->create('Magento\Catalog\Model\Product')->load($id);
        return $product->getHsn();
    }

    
    public function getOrder($id)
    {
        
       $order  = $this->objectManager->create('\Magento\Sales\Api\OrderRepositoryInterface')->get($id); 
       return $order;
    }


     public function getSelectedOptions($item){
        $result = [];
        $options = $item->getProductOptions();
        if ($options) {
            if (isset($options['options'])) {
                $result = array_merge($result, $options['options']);
            }
            if (isset($options['additional_options'])) {
                $result = array_merge($result, $options['additional_options']);
            }
            if (isset($options['attributes_info'])) {
                $result = array_merge($result, $options['attributes_info']);
            }
        }
        return $result;
    }

    /**
     * Format date
     *
     * @param string $date
     * @param string $format
     * @param bool $showTime
     * @param string $timezone
     * @param string $pattern
     * @return string
     */
    public function formatDate(
        $date = null,
        $format = \IntlDateFormatter::SHORT,
        $showTime = false,
        $timezone = null,
        $pattern = 'd MMM Y'
    ) {
        
            $date = $date instanceof \DateTimeInterface;
            return $this->_localeDate->formatDateTime(
                $date,
                $format,
                $showTime ? $format : \IntlDateFormatter::NONE,
                null,
                $timezone,
                $pattern
            );
    }


    public function getTimeAccordingToTimeZone($dateTime)
    {
        // for convert date time according to magento time zone
        $dateTimeAsTimeZone = $this->timezoneInterface
                                        ->date(new \DateTime($dateTime))
                                        ->format('d/m/y H:i A');
        return $dateTimeAsTimeZone;
    }
    


}