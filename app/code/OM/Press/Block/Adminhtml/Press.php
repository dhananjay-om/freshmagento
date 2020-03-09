<?php

/**
 * OrangeMantra.
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    OrangeMantra
 * @package     OM_Press
 * @author      Shiv Kr Maurya (Senior Magento Developer)
 * @copyright   Copyright (c) 2017 OrangeMantra
 */
namespace OM\Press\Block\Adminhtml;
 
use Magento\Backend\Block\Widget\Grid\Container;
 
class Press extends Container
{
   /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_press';
        $this->_blockGroup = 'OM_Press';
        $this->_headerText = __('Manage Press');
        $this->_addButtonLabel = __('Add Press');
        parent::_construct();
    }
}