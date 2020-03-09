<?php

namespace Om\NatureGallery\Block\Index;


class Video extends \Magento\Framework\View\Element\Template {

	public $_storeManager;
	protected $_sliderFactory;
	protected $_sectionFactory;

    public function __construct(
    	\Magento\Catalog\Block\Product\Context $context,
    	\Om\NatureGallery\Model\ContentFactory $sliderFactory,
    	\Om\NatureGallery\Model\SectionFactory $sectionFactory,
    	\Magento\Store\Model\StoreManagerInterface $storeManager,
    	 array $data = []) {

    	$this->_storeManager = $storeManager;
        $this->_sliderFactory = $sliderFactory;
         $this->_sectionFactory = $sectionFactory;

        parent::__construct($context, $data);

    }


    protected function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

     public function getBaseImagePath()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

     public function getFirstSlidesCollection()
    {
        
        $storeId = $this->_storeManager->getStore()->getId();

    	$sliderModel = $this->_sliderFactory->create();
        $sliderCollection = $sliderModel->getCollection();

        $sliderCollection->addFieldToFilter('status',1);
        $sliderCollection->addFieldToFilter('type',1);

        $sliderCollection->getSelect()->order('sortorder asc');
        return $sliderCollection;
    }

     public function getSectionCollection()
    {
        
        $storeId = $this->_storeManager->getStore()->getId();

    	$sectionModel = $this->_sectionFactory->create();
        $sectionCollection = $sectionModel->getCollection();

        $sectionCollection->addFieldToFilter('status',1);

        $sectionCollection->getSelect()->order('id asc');
        return $sectionCollection;
    }

   public function getNewInDesktopCollection($sectionid){
        $sectionModel = $this->_sectionFactory->create();
        $sectionCollection = $sectionModel->getCollection();

        if(!empty($sectionid)){
            
            $sectionCollection->addFieldToFilter('id',$sectionid);
            $sectionCollection->getSelect();
            $sectid='';
            foreach ($sectionCollection as $_section) { 
                $sectid = $_section->getSectionId();
            }

            $collection = $this->getFirstSlidesCollection()->addFieldToFilter('section', $sectid);
        }else{
             $sectionCollection->addFieldToFilter('id',1);
            $sectionCollection->getSelect();
            $sectid='';
            foreach ($sectionCollection as $_section) { 
                $sectid = $_section->getSectionId();
            }
            $collection = $this->getFirstSlidesCollection()->addFieldToFilter('section', $sectid); 
        }
        return $collection;
    }

}