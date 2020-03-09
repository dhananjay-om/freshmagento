<?php
namespace FME\Faqs\Block;

use Magento\Framework\View\Element\Template;


class Faqs extends Template
{
        protected $_topicModel;

        protected $_faqsModel;

        protected $_objectManager;
        
        protected $_coreRegistry = null;
        
        protected $urlBuilder;
        
        public function __construct( \Magento\Framework\View\Element\Template\Context $context,        
                                    \FME\Faqs\Model\Topic $topicModel,
                                    \FME\Faqs\Model\Faqs $faqsModel,
                                    \Magento\Framework\ObjectManagerInterface $objectManager,                                    
                                    \Magento\Framework\Registry $registry) {
                        
                $this->_topicModel = $topicModel;
                $this->_faqsModel = $faqsModel;
                $this->_objectManager = $objectManager;
                $this->_coreRegistry = $registry;
                $this->urlBuilder = $context->getUrlBuilder();
                
                parent::__construct($context);
        }
        
        
        public function getFrontPageTopics() {
            
                $topicsCollection = $this->_topicModel->loadFrontPageTopics();
                
                return $topicsCollection;
        }

        
        public function getFrontPageFaqs($topic_id){            
                
                $faqsCollection = $this->_faqsModel->loadFaqsOfTopic($topic_id, true);
                
                return $faqsCollection;
        }
        
        public function numberOfQuestionToDisplay(){
            
                $noq = $this->_objectManager->get('FME\Faqs\Helper\Data')->getNumOfQuestionsForFaqsPage();
                
                return $noq;
        }
        
        public function getTopicUrl($topic_id){
                
                $topic = $this->_topicModel->load($topic_id);
                $topic_identifier = $topic->getIdentifier();
                
                $main_identifier = $this->_topicModel->getMainPageIdentifer();
                $url_sufix = $this->_topicModel->getFaqsSeoIdentifierPostfix();
                
                $url = $main_identifier.'/'.$topic_identifier.$url_sufix;
                return $this->urlBuilder->getUrl($url);
        }
        
        public function getMainPageUrl(){
                              
                $main_identifier = $this->_topicModel->getMainPageIdentifer();
                $url_sufix = $this->_topicModel->getFaqsSeoIdentifierPostfix();
                
                $url = $main_identifier.$url_sufix;
                return $this->urlBuilder->getUrl($url);
        }
        
        public function getFaqUrl($faqObj){
                
                $faq_id = $faqObj->getId();
                $faq = $this->_faqsModel->load($faq_id);
                $faq_identifier = $faq->getIdentifier();
                
                $main_identifier = $this->_topicModel->getMainPageIdentifer();
                $url_sufix = $this->_topicModel->getFaqsSeoIdentifierPostfix();
                
                $url = $main_identifier.'/'.$faq_identifier.$url_sufix;
                return $this->urlBuilder->getUrl($url);
                
        }
        
        public function getFaqsBlockNumberOfTopics(){
            
                return $this->_objectManager->get('FME\Faqs\Helper\Data')->getFaqsBlockNumberOfTopics();
        }
        
        public function isViewMoreLinkEnable(){
            
                return $this->_objectManager->get('FME\Faqs\Helper\Data')->isViewMoreLinkEnable();
        }
        
        public function isAccordionEnable(){
            
                return $this->_objectManager->get('FME\Faqs\Helper\Data')->isAccordionEnable();
        }
        
        public function allowedAnswerLength(){
            
                return $this->_objectManager->get('FME\Faqs\Helper\Data')->allowedAnswerLength();
        }
        
        public function isRatingEnable(){
            
                return $this->_objectManager->get('FME\Faqs\Helper\Data')->isRatingEnable();
        }
        
        public function isCustomerRatingReadonly(){
            
                $conf = $this->_objectManager->get('FME\Faqs\Helper\Data')->getAllowedCustomerForRating();
                $customer = $this->_objectManager->get('Magento\Customer\Model\Session');
                $readonly = 'true';
                
                if($conf == 'all'){
                    $readonly = 'false';
                }else if($conf == 'guests'){
                    if(!$customer->isLoggedIn()){
                        $readonly = 'false';
                    }else{
                        $readonly = 'true';
                    }                    
                }else if($conf == 'registered'){
                    if($customer->isLoggedIn()){
                        $readonly = 'false';
                    }else{
                        $readonly = 'true';
                    }                                            
                }else{
                    
                    $readonly = 'true';
                }
                
                return $readonly;
        }
        
        public function isCustomerReadonlyStars($faq_id){
            
                // from configuration
                $conf = $this->isCustomerRatingReadonly();
                if($conf == 'true'){
                    return 1;
                }
                
                //now check if customer already rated for that faq
                $customerSession = $this->_objectManager->get('Magento\Customer\Model\Session');
                $faqRating = $customerSession->getFaqRating();
                $ar = explode(',', $faqRating);
                
                $found = array_search($faq_id, $ar);
                
                return $found;
        }
        /*
         * functions for topic detail page
         */
        
        public function getCurrentTopicDetail(){
            
            if($topicData = $this->_coreRegistry->registry('current_topic')){
                
                return $topicData;                
            }
            
            return false;
        }
        
        public function getCurrentFaqDetail(){
            
            if($faqData = $this->_coreRegistry->registry('current_faq')){
                
                return $faqData;                
            }
            
            return false;
        }
        
        public function getDetailPageFaqs($topic_id){            
                
                $faqsCollection = $this->_faqsModel->loadFaqsOfTopic($topic_id, false);
                
                return $faqsCollection;
        }
        
        public function getRatingAjaxUrl(){
            
                $rating_url = $this->urlBuilder->getUrl('faqs/index/rating');
                
                return $rating_url;
        }
        
        public function getSearchUrl(){
            
                $search_url = $this->urlBuilder->getUrl('faqs/index/search');
                
                return $search_url;
        }
        
        public function getFaqSearchDetail(){
            
            $searchData = $this->_coreRegistry->registry('faq_search_results');
               
            return $searchData;                
            
        }
        
        public function getPopularTags(){
            
            $tags = $this->_faqsModel->getPopularTags();
            return $tags;
        }
        
        public function getMediaDirectoryUrl(){
            
            $media_dir = $this->_objectManager->get('Magento\Store\Model\StoreManagerInterface')
            ->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
            
            return $media_dir;
        }
}