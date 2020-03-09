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
namespace OM\Press\Helper;
     
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;
 
class Data extends AbstractHelper
{	
   const XML_PATH_ENABLED      			= 'press_config/general/enable_in_frontend';
   const XML_PATH_SIDEBAR_ENABLED      	= 'press_config/general/enable_in_sidebar_in_frontend';
   const XML_PATH_HEAD_TITLE  			= 'press_config/general/press_heading';
   const XML_PATH_LASTEST_Press 	= 'press_config/general/press_block_position';
 
	/**
	 * @param Context $context
	 * @param ScopeConfigInterface $scopeConfig
	 */
	public function __construct(
	   Context $context
	) {
	   parent::__construct($context);
	}
 
   /**
	 * Check for module is enabled in frontend
	 *
	 * @return bool
	 */
    public function isEnabledInFrontend($store = null)
    {
	    return $this->scopeConfig->getValue(
			self::XML_PATH_ENABLED,
			ScopeInterface::SCOPE_STORE
	    );
    }

   /**
	 * Check for module is enabled in frontend
	 *
	 * @return bool
	 */
    public function isSidebarEnabledInFrontend($store = null)
    {
		return $this->scopeConfig->getValue(
			self::XML_PATH_SIDEBAR_ENABLED,
			ScopeInterface::SCOPE_STORE
		);
    }
 
   /**
	 * Get head title for press list page
	 *
	 * @return string
	 */
    public function getHeadTitle()
    {
	    return $this->scopeConfig->getValue(
		    self::XML_PATH_HEAD_TITLE,
		    ScopeInterface::SCOPE_STORE
	    );
    }
 
   /**
	 * Get lastest press block position (Left, Right, Disabled)
	 *
	 * @return int
	 */
    public function getLatestPressBlockPosition()
    {
	    return $this->scopeConfig->getValue(
		    self::XML_PATH_LASTEST_Press,
		    ScopeInterface::SCOPE_STORE
	    );
    }
}
     