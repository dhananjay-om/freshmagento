<?php

namespace Om\NatureGallery\Model\ResourceModel\Content;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Om\NatureGallery\Model\Content', 'Om\NatureGallery\Model\ResourceModel\Content');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>