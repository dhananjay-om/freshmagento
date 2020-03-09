<?php
/**
 * @category   OM
 * @package    OM_VideoGallery
 * @author     kumar.dhananjay@orangemantra.in
 * @copyright  This file was generated by using Module Creator(http://code.vky.co.in/magento-2-module-creator/) provided by VKY <viky.031290@gmail.com>
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace OM\VideoGallery\Model\ResourceModel\VideoGallery;
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'videogallery_id';
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'OM\VideoGallery\Model\VideoGallery',
            'OM\VideoGallery\Model\ResourceModel\VideoGallery'
        );
    }
}