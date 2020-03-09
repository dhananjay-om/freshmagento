<?php
/**
 * @category   OM
 * @package    OM_Gallery
 * @author     kumar.dhananjay@orangemantra.in
 * @copyright  This file was generated by using Module Creator(http://code.vky.co.in/magento-2-module-creator/) provided by VKY <viky.031290@gmail.com>
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace OM\Gallery\Block;

use Magento\Framework\View\Element\Template\Context;
use OM\Gallery\Model\GalleryFactory;
use Magento\Cms\Model\Template\FilterProvider;
/**
 * Gallery View block
 */
class GalleryView extends \Magento\Framework\View\Element\Template
{
    /**
     * @var Gallery
     */
    protected $_gallery;
    public function __construct(
        Context $context,
        GalleryFactory $gallery,
        FilterProvider $filterProvider
    ) {
        $this->_gallery = $gallery;
        $this->_filterProvider = $filterProvider;
        parent::__construct($context);
    }

    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('OM Gallery Module View Page'));
        
        return parent::_prepareLayout();
    }

    public function getSingleData()
    {
        $id = $this->getRequest()->getParam('id');
        $gallery = $this->_gallery->create();
        $singleData = $gallery->load($id);
        if($singleData->getGalleryId() || $singleData['gallery_id'] && $singleData->getStatus() == 1){
            return $singleData;
        }else{
            return false;
        }
    }
}