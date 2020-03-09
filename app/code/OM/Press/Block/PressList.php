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
namespace OM\Press\Block;
use Magento\Framework\View\Element\Template;
use OM\Press\Model\PressFactory;
 
class PressList extends Template
{
  /**
  * @var \OM\Press\Model\PressFactory
  */
  protected $_PressFactory;
 
  /**
  * @param Template\Context $context
  * @param PressFactory $PressFactory
  * @param array $data
  */
  public function __construct(
    Template\Context $context,
		PressFactory $PressFactory,
		array $data = []
		)
    {
      $this->_PressFactory = $PressFactory;
      parent::__construct($context, $data);
    }
 
   /**
     * Set Press collection
     */
  protected  function _construct()
  {
    parent::_construct();
		$collection = $this->_PressFactory->create()->getCollection();
		$collection->addFieldToFilter('status',['eq' => \OM\Press\Model\System\Config\Status::ENABLED]);
		$collection->addFieldToFilter('store_id', [['finset' => $this->getCurrentStoreId()],['finset' => 0]]);	
		$collection->getSelect()->order('press_date DESC');   
    $this->setCollection($collection);
  }
 
  /**
  * @return $this
  */
  protected function _prepareLayout()
  {
    parent::_prepareLayout();
    /** @var \Magento\Theme\Block\Html\Pager */
    $pager = $this->getLayout()->createBlock(
       'Magento\Theme\Block\Html\Pager',
       'om.Press.list.pager'
    );
    $pager
        ->setLimit(24)
        ->setShowAmounts(false)
        ->setCollection($this->getCollection());
    $this->setChild('pager', $pager);
    $this->getCollection()->load();
    return $this;
  }
 
 /**
   * @return string
   */
  public function getPagerHtml()
  {
    return $this->getChildHtml('pager');
  }

	public function getSlideModes()
  {
    return  \OM\Press\Model\System\Config\PressList\Slidemode::getSlideModes();
  }
	
	public function getCurrentStoreId() 
  {
 		return $this->_storeManager->getStore()->getStoreId(); 
	}

	public function getMediaPath()
  {
		$_objectManager = \Magento\Framework\App\ObjectManager::getInstance(); 
		$storeManager = $_objectManager->get('Magento\Store\Model\StoreManagerInterface'); 
		$currentStore = $storeManager->getStore();
		return $currentStore->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
	}
}