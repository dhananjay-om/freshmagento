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
namespace OM\Press\Controller\Adminhtml\Press;
 
use OM\Press\Controller\Adminhtml\Press;
 
class NewAction extends Press
{
   /**
     * Create new Press action
     *
     * @return void
     */
    public function execute()
    {
      $this->_forward('edit');
    }
}