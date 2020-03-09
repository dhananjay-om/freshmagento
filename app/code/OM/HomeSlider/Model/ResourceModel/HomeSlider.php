<?php
/**
 * @category   OM
 * @package    OM_HomeSlider
 * @author     kumar.dhananjay@orangemantra.in
 * @copyright  This file was generated by using Module Creator(http://code.vky.co.in/magento-2-module-creator/) provided by VKY <viky.031290@gmail.com>
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace OM\HomeSlider\Model\ResourceModel;

class HomeSlider extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('om_homeslider', 'homeslider_id');   //here "om_homeslider" is table name and "homeslider_id" is the primary key of custom table
    }
}