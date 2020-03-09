<?php

namespace Om\NatureGallery\Model\ResourceModel\Section;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Om\NatureGallery\Model\Section', 'Om\NatureGallery\Model\ResourceModel\Section');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>