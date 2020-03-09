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
namespace OM\Press\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Result\PageFactory;
use OM\Press\Model\PressFactory;
use OM\Press\Helper\Data;
use OM\Press\Controller\Press;

class View extends Press
{
    public function execute()
    {
        $pressId = $this->getRequest()->getParam('id');
        $press = $this->_pressFactory->create()->load($pressId);
        $this->_objectManager->get('Magento\Framework\Registry')
            ->register('pressData', $press);
        $pageFactory = $this->_pageFactory->create();
        $pageFactory->getConfig()->getTitle()->set($press->getTitle());
        /** @var \Magento\Theme\Block\Html\Breadcrumbs */
        $breadcrumbs = $pageFactory->getLayout()->getBlock('breadcrumbs');
        $breadcrumbs->addCrumb('home',
            [
                'label' => __('Home'),
                'title' => __('Home'),
                'link' => $this->_url->getUrl('')
            ]
        );
        $breadcrumbs->addCrumb('press',
            [
                'label' => __('press'),
                'title' => __('press'),
                'link' => $this->_url->getUrl('press')
            ]
        );
        $breadcrumbs->addCrumb('press',
            [
                'label' => $press->getTitle(),
                'title' => $press->getTitle()
            ]
        );
        return $pageFactory;
    }
}