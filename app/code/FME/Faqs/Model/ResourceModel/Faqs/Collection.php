<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace FME\Faqs\Model\ResourceModel\Faqs;

use \FME\Faqs\Model\ResourceModel\AbstractCollection;

/**
 *  collection
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'faq_id';

    /**
     * Load data for preview flag
     *
     * @var bool
     */
    protected $_previewFlag;

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('FME\Faqs\Model\Faqs', 'FME\Faqs\Model\ResourceModel\Faqs');
        $this->_map['fields']['faq_id'] = 'main_table.faq_id';
        
    }

    
    /**
     * Add filter by store
     *
     * @param int|array|\Magento\Store\Model\Store $store
     * @param bool $withAdmin
     * @return $this
     */
    public function addStoreFilter($store, $withAdmin = true)
    {
        if (!$this->getFlag('store_filter_added')) {
            $this->performAddStoreFilter($store, $withAdmin);
        }
        return $this;
    }
    
    
    public function joinTopicTable()
    {
        $this->_select->joinLeft(
            ['topic_table' => $this->getTable('fme_faqs_topic')],
            'main_table.faqs_topic_id = topic_table.faqs_topic_id',
            ['t_title' => 'title', 
                't_identifier' => 'identifier',
                't_status' => 'status',
                't_show_on_main' => 'show_on_main',
                't_topic_order' => 'topic_order']
        );
        return $this;
    }
    
    public function joinStoreTable()
    {
        $this->_select->joinLeft(
            ['store_table' => $this->getTable('fme_faqs_topic_store')],
            'main_table.faqs_topic_id = store_table.faqs_topic_id',
            ['store_id' => 'store_id']
        );
        return $this;
    }
}
