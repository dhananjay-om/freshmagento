<?php
namespace Om\NatureGallery\Model;

class Section extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Om\NatureGallery\Model\ResourceModel\Section');
    }
}
?>