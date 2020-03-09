<?php
namespace Om\NatureGallery\Model\ResourceModel;

class Content extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('om_content', 'id');
    }
}
?>