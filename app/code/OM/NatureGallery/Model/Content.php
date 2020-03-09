<?php
namespace Om\NatureGallery\Model;

class Content extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Om\NatureGallery\Model\ResourceModel\Content');
    }
}
?>