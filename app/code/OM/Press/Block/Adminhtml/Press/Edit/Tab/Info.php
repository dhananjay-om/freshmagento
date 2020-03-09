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
namespace OM\Press\Block\Adminhtml\Press\Edit\Tab;
 
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;
use Magento\Store\Model\System\Store;

use OM\Press\Model\System\Config\Status;
 
class Info extends Generic implements TabInterface
{
    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;
    
    protected $_systemStore;
 
    /**
     * @var \OM\Press\Model\Config\Status
     */
    protected $_pressStatus;
 
   /**
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param Config $wysiwygConfig
     * @param Status $pressStatus
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Config $wysiwygConfig,
        Status $pressStatus,
        Store $systemStore,
        array $data = []
    ){
       
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_pressStatus = $pressStatus;
         $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }
 
    /**
     * Prepare form fields
     *
     * @return \Magento\Backend\Block\Widget\Form
     */
    protected function _prepareForm()
    {
       /** @var $model \Om\Press\Model\Press */
        $model = $this->_coreRegistry->registry('press_press');
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('press');
        $form->setFieldNameSuffix('press');
        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General')]
        );
        if ($model->getId()) {
            $fieldset->addField(
                'id',
                'hidden',
                ['name' => 'id']
            );
        }
        $fieldset->addField(
            'title',
            'text',
            [
                'name'        => 'title',
                'label'    => __('Title'),
                'required'     => true
            ]
        );
       $wysiwygConfig = $this->_wysiwygConfig->getConfig();
        $fieldset->addField(
            'text',
            'editor',
            [
                'name'        => 'text',
                'label'    => __('Short Content'),
                'required'     => true,
                'config'    => $wysiwygConfig
            ]
        );
        $fieldset->addField(
            'image',
            'image',
            [
                'name' => 'image',
                'label' => __('Press Picture'),             
                'note' => 'Allow image type: jpg, jpeg, png',
            ]
        );
        $fieldset->addField(
            'name',
            'text',
            [
                'name'        => 'name',
                'label'    => __('Author Name'),
                'required'     => false
            ]
        ); 
       
        $fieldset->addField(

            'press_date',
            'date',
            [
                'name' => 'press_date',
                'label' => __('Press Date'),
                'image' => $this->getSkinUrl('images/grid-cal.gif'),
                'date_format' => 'yyyy-MM-dd',
                'time_format' => 'hh:mm:ss'

            ]

        );
		$fieldset->addField(
            'status',
            'select',
            [
                'name'      => 'status',
                'label'     => __('Status'),
                'options'   => $this->_pressStatus->toOptionArray()
            ]
        );
	   $fieldset->addField(
           'store_id',
           'multiselect',
           [
             'name'     => 'store_ids[]',
             'label'    => __('Store Views'),
             'title'    => __('Store Views'),
             'required' => true,
             'values'   => $this->_systemStore->getStoreValuesForForm(false, true),
           ]
        );
		$fieldset->addField(
            'sort_order',
            'text',
            [
                'name'        => 'sort_order',
                'label'    => __('Sort Order'),
                'required'     => true
            ]
        );
        $fieldset->addField(
            'url',
            'text',
            [
                'name'        => 'url',
                'label'    => __('URL'),
                'required'     => false
            ]
        );    
        $data = $model->getData();
        $form->setValues($data);
        $this->setForm($form);
 
        return parent::_prepareForm();
    }
 
    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Press Info');
    }
 
    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Press Info');
    }
 
    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }
 
    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }
}