<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace FME\Faqs\Helper;

use Magento\Store\Model\Store;


class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    
    const XML_FAQS_ENABLE               = 'faqs/list/enabled';
    const XML_FAQS_PAGE_TITLE           = 'faqs/list/page_title';
    const XML_FAQS_IDENTIFIER           = 'faqs/list/identifier';
    const XML_FAQS_META_KEYWORDS        = 'faqs/list/meta_keywords';
    const XML_FAQS_META_DESC            = 'faqs/list/meta_description';
    const XML_FAQS_DISPLAY_TOPICS       = 'faqs/list/display_topics';
    const XML_FAQS_NUM_OF_QUESTIONS     = 'faqs/list/show_number_of_questions';
    const XML_FAQS_VIEW_MORE            = 'faqs/list/enable_view_more';
    const XML_FAQS_ACCORDION            = 'faqs/list/enable_accordion';
    const XML_ANSWER_LENGTH             = 'faqs/list/answer_length';
    
    const XML_RATING_ENABLE             = 'faqs/rating/enable';
    const XML_FAQS_ALLOW_CUSTOMERS      = 'faqs/rating/allow_customers';
    
    const XML_FAQS_BLOCK                = 'faqs/general/faq_block';
    const XML_FAQS_SEARCH_BLOCK         = 'faqs/general/faq_search_block';
    const XML_FAQS_MAX_TOPIC            = 'faqs/general/faq_maxtopic';
    const XML_TAGS_BLOCK                = 'faqs/general/tags_block';
    const XML_MAX_TAGS                  = 'faqs/general/max_tags';
    
    const XML_FAQS_URL_SUFFIX           = 'faqs/seo/url_suffix';
    

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    
    
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager        
    ) {
        
        $this->_storeManager = $storeManager;
        
        parent::__construct($context);
    }
    
    public function isModuleEnabled(){
        
        if($this->isModuleOutputEnabled('FME_Faqs') &&
                $this->scopeConfig->isSetFlag(
            self::XML_FAQS_ENABLE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        )){
            return true;
        }
    }
    
    
    public function getFaqsPageTitle(){
        
        return $this->scopeConfig->getValue(
            self::XML_FAQS_PAGE_TITLE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    
    
    public function getFaqsPageIdentifier(){
        
        return $this->scopeConfig->getValue(
            self::XML_FAQS_IDENTIFIER,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getFaqsPageMetaKeywords(){
        
        return $this->scopeConfig->getValue(
            self::XML_FAQS_META_KEYWORDS,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    
    public function getFaqsPageMetaDesc(){
        
        return $this->scopeConfig->getValue(
            self::XML_FAQS_META_DESC,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    
    public function displaySelectedTopics(){
        
        return $this->scopeConfig->getValue(
            self::XML_FAQS_DISPLAY_TOPICS, 
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );        
    }
    
    public function getNumOfQuestionsForFaqsPage(){
        
        return $this->scopeConfig->getValue(
            self::XML_FAQS_NUM_OF_QUESTIONS, 
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );        
    }
    
    public function isViewMoreLinkEnable(){
        
        return $this->scopeConfig->getValue(
            self::XML_FAQS_VIEW_MORE, 
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    
    public function isAccordionEnable(){
        
        return $this->scopeConfig->getValue(
            self::XML_FAQS_ACCORDION,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    
    public function allowedAnswerLength(){
        
        $length = $this->scopeConfig->getValue(
            self::XML_ANSWER_LENGTH,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        
        return ($length == '') ? 0 : $length;
    }
    
    public function isRatingEnable(){
        
        return $this->scopeConfig->getValue(
            self::XML_RATING_ENABLE, 
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );        
    }
    
    public function getAllowedCustomerForRating(){
        
        return $this->scopeConfig->getValue(
            self::XML_FAQS_ALLOW_CUSTOMERS,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    
    public function isFaqsBlockEnable(){
        
        return $this->scopeConfig->getValue(
            self::XML_FAQS_BLOCK, 
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    
    public function isFaqsSearchBlockEnable(){
        
        return $this->scopeConfig->getValue(
            self::XML_FAQS_SEARCH_BLOCK,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    
    public function getFaqsBlockNumberOfTopics(){
        
        return $this->scopeConfig->getValue(
            self::XML_FAQS_MAX_TOPIC,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    
    public function getTagsMaxNum(){
        
        return $this->scopeConfig->getValue(
            self::XML_MAX_TAGS,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    
    public function getFaqsSeoIdentifierPostfix(){
        
        return $this->scopeConfig->getValue(
            self::XML_FAQS_URL_SUFFIX, 
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    
    
    
    
    
}

