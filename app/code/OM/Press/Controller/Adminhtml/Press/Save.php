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
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends Press
{
   /**
     * @return void
     */
    public function execute()
    {
        $isPost = $this->getRequest()->getPost();
        if ($isPost) {
        	echo "<pre>";
        	var_dump($isPost);die();
	        $pressModel = $this->_pressFactory->create();
			$formData = $this->getRequest()->getParam('press');
	        if (isset($formData['id'])) {
				$pressId = $formData['id'];
	            $pressModel->load($formData['id']);
	        }
	        $formData = $this->getRequest()->getParam('press');
			$pressModel->setTitle($formData['title']);
			$pressModel->setText($formData['text']);
			$pressModel->setStatus($formData['status']);
			$pressModel->setPressDate($formData['press_date']);
			$pressModel->setName($formData['name']);
			$pressModel->setUrl($formData['url']);		
			$pressModel->setSortOrder($formData['sort_order']);
			$pressModel->setStoreId(implode(',',$formData['store_ids']));
			/* upload images for press */
			if(isset($formData['image']) && isset($formData['image']['delete'])){
				$pressModel->setImage('');
			}
			$imageRequest = $this->getRequest()->getFiles('image');
			if(isset($imageRequest['name']) && $imageRequest['name']!= ''){
	            if (isset($imageRequest['name'])) {
	                $img = $this->uploadFileAndGetName();
	                $pressModel->setImage($img);
	            }
	        }
	        try 
	        {
	            $pressModel->save();
	            $this->messageManager->addSuccess(__('The press has been saved.'));
	            if ($this->getRequest()->getParam('back')) {
	               $this->_redirect('*/*/edit', ['id' => $pressModel->getId(), '_current' => true]);
	               return;
	            }
	            $this->_redirect('*/*/');
	            return;
	        }catch (\Exception $e) {
	            $this->messageManager->addError($e->getMessage());
	        }
	        $this->_getSession()->setFormData($formData);
	        $this->_redirect('*/*/edit', ['id' => $pressId]);
        }
    }
   
	public function uploadFileAndGetName()
	{	
	   $destinationPath = $this->getDestinationPath();
	   $destinationPath .= 'press/';
	  	try{
			$uploader = $this->uploaderFactory->create(['fileId' => $this->fileId])
				->setAllowCreateFolders(true)
				->setAllowedExtensions($this->allowedExtensions)
				->setAllowRenameFiles(true)
				->addValidateCallback('validate', $this, 'validateFile');
			$result = $uploader->save($destinationPath);
		
			if (!$result) {
				throw new \Magento\Framework\Exception\LocalizedException(
	                __('File cannot be saved to path: $1', $destinationPath)
	            );
			}
			return 'press/'.$result['file'];
		} catch (\Exception $e) {
			$this->messageManager->addError(
				__($e->getMessage())
			);
		}	
	}

	public function validateFile($filePath)
    {
       
    }

	public function getDestinationPath()
    {
        return $this->fileSystem
            ->getDirectoryWrite(DirectoryList::MEDIA)
            ->getAbsolutePath('/');
    }
}