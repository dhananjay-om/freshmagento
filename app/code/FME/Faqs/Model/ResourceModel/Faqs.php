<?php

namespace FME\Faqs\Model\ResourceModel;

class Faqs extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
        
        protected $_storeManager;
        
        public function __construct(
            \Magento\Framework\Model\ResourceModel\Db\Context $context,
            \Magento\Store\Model\StoreManagerInterface $storeManager,
            $connectionName = null
        ) {
            parent::__construct($context, $connectionName);
            $this->_storeManager = $storeManager;
        }
           
        protected function _construct()
        {
                $this->_init('fme_faq', 'faq_id');
        }
        
        
        protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object) {            
            
            
            if(!$this->isValidIdentifier($object)){
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('The faq URL key contains capital letters or disallowed symbols.')
                );
            }
            
            if($this->isNumericIdentifier($object)){                
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('The faq URL key cannot be made of only numbers.')
                );
            }


               
            if(!$this->getIsUniqueIdentifier($object)){
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('URL key for specified faq already exists.')
                );
            }
                        
            
            return parent::_beforeSave($object);
        }
        
        
        
        /**
        *  Check whether  identifier is numeric
        *
        * @param \Magento\Framework\Model\AbstractModel $object
        * @return bool
        */
        protected function isNumericIdentifier(\Magento\Framework\Model\AbstractModel $object)
        {
            return preg_match('/^[0-9]+$/', $object->getData('identifier'));
        }

        /**
         *  Check whether  identifier is valid
         *
         * @param \Magento\Framework\Model\AbstractModel $object
         * @return bool
         */
        protected function isValidIdentifier(\Magento\Framework\Model\AbstractModel $object)
        {
            return preg_match('/^[a-z0-9][a-z0-9_\/-]+(\.[a-z0-9_-]+)?$/', $object->getData('identifier'));
        }
        
        /**
        * Check for unique of identifier.
        *
        * @param \Magento\Framework\Model\AbstractModel $object
        * @return bool
        * @SuppressWarnings(PHPMD.BooleanGetMethodName)
        */
        public function getIsUniqueIdentifier(\Magento\Framework\Model\AbstractModel $object)
        {
            
            $select = $this->getConnection()->select()->from(
                ['f' => $this->getMainTable()]
            )->where(
                'f.identifier = ?',
                $object->getData('identifier')
            );

            if ($object->getId()) { //in edit mode, compare other then current
                $select->where('f.faq_id <> ?', $object->getId());
            }

            if ($this->getConnection()->fetchRow($select)) {
                return false;
            }

            return true;
        }
        
        
        public function checkIdentifier($identifier)
        {            
            $select = $this->_getLoadByIdentifierSelect($identifier, 1);
            $select->reset(\Magento\Framework\DB\Select::COLUMNS)->columns('f.faq_id')->limit(1);

            return $this->getConnection()->fetchOne($select);
        }
        
        
        protected function _getLoadByIdentifierSelect($identifier, $isActive = null)
        {
            $select = $this->getConnection()->select()->from(
                ['f' => $this->getMainTable()]
            )->where(
                'f.identifier = ?',
                $identifier
            );

            if (!is_null($isActive)) {
                $select->where('f.status = ?', $isActive);
            }

            return $select;
        }
}