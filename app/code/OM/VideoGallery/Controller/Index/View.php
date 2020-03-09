<?php
/**
 * @category   OM
 * @package    OM_VideoGallery
 * @author     kumar.dhananjay@orangemantra.in
 * @copyright  This file was generated by using Module Creator(http://code.vky.co.in/magento-2-module-creator/) provided by VKY <viky.031290@gmail.com>
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace OM\VideoGallery\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\NotFoundException;
use OM\VideoGallery\Block\VideoGalleryView;

class View extends \Magento\Framework\App\Action\Action
{
	protected $_videogalleryview;

	public function __construct(
        Context $context,
        VideoGalleryView $videogalleryview
    ) {
        $this->_videogalleryview = $videogalleryview;
        parent::__construct($context);
    }

	public function execute()
    {
    	if(!$this->_videogalleryview->getSingleData()){
    		throw new NotFoundException(__('Parameter is incorrect.'));
    	}
    	
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}