<?php
namespace OM\Rewrites\Controller;

use Magento\Framework\Module\Manager;

class Router implements \Magento\Framework\App\RouterInterface
{
    /** @var \Magento\Framework\App\ActionFactory */
    protected $_actionFactory;

    /** @var \Magento\Framework\App\ResponseInterface */
    protected $_response;

    /** @var  Manager */
    protected $_moduleManager;

    /** @var  Page */
    protected $_page;

    public function __construct(
        \Magento\Framework\App\ActionFactory $actionFactory, 
        \Magento\Framework\App\ResponseInterface $response, 
        Manager $moduleManager,
        \Magento\Cms\Model\Page $page
    )
    {
        $this->_actionFactory = $actionFactory;
        $this->_response = $response;
        $this->_moduleManager = $moduleManager;
        $this->_page = $page;
    }

    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
$logger = new \Zend\Log\Logger();
$logger->addWriter($writer);
$logger->info('php extension found'); 
        $identifier = trim($request->getPathInfo() , '/');
        $identifier = current(explode("/", $identifier));
        
        if(strpos($identifier, '.php') !== false) {
            $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
$logger = new \Zend\Log\Logger();
$logger->addWriter($writer);
$logger->info('php extension found');
            $pageId = $this->_page->load($identifier, 'identifier')->getPageId();
            if ($pageId)
            {
                $request->setModuleName('cms')
                        ->setControllerName('page')
                        ->setActionName('view')
                        ->setParam('page_id', $pageId);
                $request->setAlias(\Magento\Framework\Url::REWRITE_REQUEST_PATH_ALIAS, $identifier);
                
$logger->info('page extnsion  not found'); 
                return $this
                    ->_actionFactory
                    ->create('Magento\Framework\App\Action\Forward');
            }
        }
    }
}
