<?php
namespace Om\NatureGallery\Block\Adminhtml\Content\Edit\Tab\Renderer;
use Magento\Framework\DataObject;

class Preview extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
    /**
     * get Image
     * @param  DataObject $row
     * @return string
     */
    public function render(DataObject $row)
    {
        $objectManager =  \Magento\Framework\App\ObjectManager::getInstance();
        $storeManager = $objectManager->get('\Magento\Store\Model\StoreManagerInterface');
        $store = $storeManager->getStore();

        $image = $store->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA).$row->getImage();
        return "<img width='100' src='".$image."' />";
    }
}