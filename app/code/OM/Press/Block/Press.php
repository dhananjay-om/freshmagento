<?php
namespace OM\Press\Block;

use Magento\Framework\View\Element\Template;
use OM\Press\Helper\Data;
use OM\Press\Model\PressFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
 
class Press extends Template
{
   /**
    * @var \OM\Press\Helper\Data
    */
   protected $_dataHelper;
   protected $_storeManager;
   protected $_directory_list;
   protected $_status;
 
   /**
    * @var \OM\Press\Model\PressFactory
    */
   protected $_PressFactory;
 
   /**
    * @param Template\Context $context
    * @param Data $dataHelper
    * @param PressFactory $PressFactory
    */
   public function __construct(
      Template\Context $context,
      Data $dataHelper,
      PressFactory $PressFactory,
	    DirectoryList $directory_list
   ) {
      $this->_dataHelper = $dataHelper;
      $this->_PressFactory = $PressFactory;
      parent::__construct($context);
	    $this->_directory_list = $directory_list;
   }
	
	 public function getSlideModes()
   {    
		return  \OM\Press\Model\System\Config\PressList\Slidemode::getSlideModes();
   }

   /**
    * Get five latest Press
    *
    * @return \OM\Press\Model\ResourceModel\Press\Collection
    */
   public function getLatestPress()
   {	 
      $collection = $this->_PressFactory->create()->getCollection();
      $collection->addFieldToFilter('status',['eq' => \OM\Press\Model\System\Config\Status::ENABLED])->setPageSize(5)->setCurPage(1);
      $collection->addFieldToFilter('store_id', [['finset' => $this->getCurrentStoreId()],['finset' => 0]]);
      $collection->getSelect()->order('press_date DESC');
      return $collection;
   }

   public function getConfig($key)
   {
  		if($key != ''){
  			return $this->_scopeConfig->getValue($key, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
  		}
	 }
	
	public function getMediaPath()
  {
		$_objectManager = \Magento\Framework\App\ObjectManager::getInstance(); 
		$storeManager = $_objectManager->get('Magento\Store\Model\StoreManagerInterface'); 
		$currentStore = $storeManager->getStore();
		return $currentStore->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
	}

	public function getCurrentStoreId() 
  {
		 return $this->_storeManager->getStore()->getStoreId(); 
 	}
	
}