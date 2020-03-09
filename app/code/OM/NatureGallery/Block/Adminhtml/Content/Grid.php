<?php
namespace Om\NatureGallery\Block\Adminhtml\Content;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \Om\NatureGallery\Model\contentFactory
     */
    protected $_contentFactory;

    /**
     * @var \Om\NatureGallery\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Om\NatureGallery\Model\contentFactory $contentFactory
     * @param \Om\NatureGallery\Model\Status $status
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Om\NatureGallery\Model\ContentFactory $ContentFactory,
        \Om\NatureGallery\Model\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_contentFactory = $ContentFactory;
        $this->_status = $status;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('postGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
        $this->setVarNameFilter('post_filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_contentFactory->create()->getCollection();
        $this->setCollection($collection);

        parent::_prepareCollection();

        return $this;
    }

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
            ]
        );

         $this->addColumn(
                    'image',
                    [
                        'header' => __('Preview'),
                        'index' => 'image',
                        'filter' => false,
                        'renderer'  => 'Om\NatureGallery\Block\Adminhtml\Content\Edit\Tab\Renderer\Preview'
                    ]
                );
		
						
						$this->addColumn(
							'type',
							[
								'header' => __('Type'),
								'index' => 'type',
								'type' => 'options',
								'options' => \Om\NatureGallery\Block\Adminhtml\Content\Grid::getOptionArray1()
							]
						);
						
						
				$this->addColumn(
					'title',
					[
						'header' => __('Title'),
						'index' => 'title',
					]
				);
				
				$this->addColumn(
					'sortorder',
					[
						'header' => __('Sort Order'),
						'index' => 'sortorder',
					]
				);
				
						
						$this->addColumn(
							'status',
							[
								'header' => __('Status'),
								'index' => 'status',
								'type' => 'options',
								'options' => \Om\NatureGallery\Block\Adminhtml\Content\Grid::getOptionArray4()
							]
						);
						
						
				$this->addColumn(
					'video_url',
					[
						'header' => __('Video Url'),
						'index' => 'video_url',
					]
				);
				
				$this->addColumn(
					'url',
					[
						'header' => __('Url'),
						'index' => 'url',
					]
				);
				
						
						$this->addColumn(
							'section',
							[
								'header' => __('Select Category'),
								'index' => 'section',
								'type' => 'options',
								'options' => \Om\NatureGallery\Block\Adminhtml\Content\Grid::getOptionArray16()
							]
						);
						
						


		
        //$this->addColumn(
            //'edit',
            //[
                //'header' => __('Edit'),
                //'type' => 'action',
                //'getter' => 'getId',
                //'actions' => [
                    //[
                        //'caption' => __('Edit'),
                        //'url' => [
                            //'base' => '*/*/edit'
                        //],
                        //'field' => 'id'
                    //]
                //],
                //'filter' => false,
                //'sortable' => false,
                //'index' => 'stores',
                //'header_css_class' => 'col-action',
                //'column_css_class' => 'col-action'
            //]
        //);
		

		
		   $this->addExportType($this->getUrl('naturegallery/*/exportCsv', ['_current' => true]),__('CSV'));
		   $this->addExportType($this->getUrl('naturegallery/*/exportExcel', ['_current' => true]),__('Excel XML'));

        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

	
    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {

        $this->setMassactionIdField('id');
        //$this->getMassactionBlock()->setTemplate('Om_NatureGallery::content/grid/massaction_extended.phtml');
        $this->getMassactionBlock()->setFormFieldName('content');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('naturegallery/*/massDelete'),
                'confirm' => __('Are you sure?')
            ]
        );

        $statuses = $this->_status->getOptionArray();

        $this->getMassactionBlock()->addItem(
            'status',
            [
                'label' => __('Change status'),
                'url' => $this->getUrl('naturegallery/*/massStatus', ['_current' => true]),
                'additional' => [
                    'visibility' => [
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => __('Status'),
                        'values' => $statuses
                    ]
                ]
            ]
        );


        return $this;
    }
		

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('naturegallery/*/index', ['_current' => true]);
    }

    /**
     * @param \Om\NatureGallery\Model\content|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
		
        return $this->getUrl(
            'naturegallery/*/edit',
            ['id' => $row->getId()]
        );
		
    }

	
		static public function getOptionArray1()
		{
            $data_array=array(); 
			$data_array[0]='Image';
			$data_array[1]='Video';
            return($data_array);
		}
		static public function getValueArray1()
		{
            $data_array=array();
			foreach(\Om\NatureGallery\Block\Adminhtml\Content\Grid::getOptionArray1() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);		
			}
            return($data_array);

		}
		
		static public function getOptionArray4()
		{
            $data_array=array(); 
			$data_array[0]='Disable';
			$data_array[1]='Enable';
            return($data_array);
		}
		static public function getValueArray4()
		{
            $data_array=array();
			foreach(\Om\NatureGallery\Block\Adminhtml\Content\Grid::getOptionArray4() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);		
			}
            return($data_array);

		}
		
		static public function getOptionArray16()
		{
             $data_array=array(); 
            $_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $section_collection = $_objectManager->create('Om\NatureGallery\Model\Section')->getCollection();
            foreach ($section_collection as $collection) {
                $data_array[$collection->getSectionId()] = $collection->getSectionTitle();
            }
            return($data_array);
		}

		static public function getValueArray16()
		{
            $data_array=array();
			foreach(\Om\NatureGallery\Block\Adminhtml\Content\Grid::getOptionArray16() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);		
			}
            return($data_array);

		}
		

}