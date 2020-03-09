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
namespace OM\Press\Controller;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Result\PageFactory;

use OM\Press\Helper\Data;
use OM\Press\Model\PressFactory;

abstract class Press extends Action
{
  /**
  * @var \Magento\Framework\View\Result\PageFactory
  */
  protected $_pageFactory;
 
  /**
  * @var \OM\Press\Helper\Data
  */
  protected $_dataHelper;
 
  /**
  * @var \OM\Press\Model\Press
  */
  protected $_pressFactory;
 
  /**
  * @param Context $context
  * @param PageFactory $pageFactory
  * @param Data $dataHelper
  * @param Press $pressFactory
  */
  public function __construct(
    Context $context,
    PageFactory $pageFactory,
    Data $dataHelper,
    PressFactory $pressFactory
  ) {
    parent::__construct($context);
    $this->_pageFactory = $pageFactory;
    $this->_dataHelper = $dataHelper;
    $this->_pressFactory = $pressFactory;
  }
 
  /**
  * Dispatch request
  *
  * @param RequestInterface $request
  * @return \Magento\Framework\App\ResponseInterface
  */
  public function dispatch(RequestInterface $request)
  {
    // Check this module is enabled in frontend
    if ($this->_dataHelper->isEnabledInFrontend()) {
      $result = parent::dispatch($request);
      return $result;
    } 
    else 
    {
      $this->_forward('noroute');
    }
  }
}