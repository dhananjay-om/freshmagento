<?php

namespace FME\Faqs\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
        
        
        
        public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context){
            
                
                if (version_compare($context->getVersion(), '1.0.2', '<')) {
                        
                        
                        $installer = $setup;                
                        $installer->startSetup();
                        
                        
                                $topic_table = $installer->getConnection()->newTable($installer->getTable('fme_faqs_topic'))
                                        ->addColumn('faqs_topic_id',
                                                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                                                    null,
                                                    ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                                                    'Topic ID'
                                                    )
                                        ->addColumn('title',
                                                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                                    255,
                                                    ['nullable' => true, 'default' => null],
                                                    'Title'
                                                    )
                                        ->addColumn('identifier',
                                                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                                    255,
                                                    [],
                                                    'Url Identifier'
                                                    )
                                        ->addColumn('image',
                                                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                                    255,
                                                    ['nullable' => true, 'default' => null],
                                                    'Topic Image'
                                                    )
                                        ->addColumn('status',
                                                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                                                    null,
                                                    ['unsigned' => true, 'nullable' => false, 'default' => '0'],
                                                    'Status'
                                                    )
                                        ->addColumn('show_on_main',
                                                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                                                    null,
                                                    ['unsigned' => true, 'nullable' => false, 'default' => '0'],
                                                    'Show On Main Page'
                                                    )
                                        ->addColumn('topic_order',
                                                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                                                    null,
                                                    ['unsigned' => true, 'nullable' => false, 'default' => '0'],
                                                    'Sorting Order'
                                                    )
                                        ->addColumn('create_date',
                                                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                                                    null,
                                                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                                                    'Creation Date'
                                                    )
                                        ->addColumn('update_date',
                                                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                                                    null,
                                                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                                                    'Update Date'
                                                    );                
                
                                $installer->getConnection()->createTable($topic_table);
                                
                                
                                
                                
                                
                                
                                /**
                                * Create table 'fme_faqs_topic_store'
                                */
                                $store_table = $installer->getConnection()->newTable($installer->getTable('fme_faqs_topic_store')
                                                        )->addColumn(
                                                            'faqs_topic_id',
                                                            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                                                            null,
                                                            ['nullable' => false, 'unsigned' => true,'primary' => true],
                                                            'Faqs Topic ID'
                                                        )->addColumn(
                                                            'store_id',
                                                            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                                                            null,
                                                            ['unsigned' => true, 'nullable' => false, 'primary' => true],
                                                            'Store ID'
                                                        )->addIndex(
                                                            $installer->getIdxName('fme_faqs_topic_store', ['store_id']),
                                                            ['store_id']
                                                        )->addForeignKey(
                                                            $installer->getFkName('fme_ft_store', 'ft_id', 'fme_ft', 'ft_id'),
                                                            'faqs_topic_id',
                                                            $installer->getTable('fme_faqs_topic'),
                                                            'faqs_topic_id',
                                                            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                                                        )->addForeignKey(
                                                            $installer->getFkName('fme_ft_store', 'store_id', 'store', 'store_id'),
                                                            'store_id',
                                                            $installer->getTable('store'),
                                                            'store_id',
                                                            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                                                        )->setComment(
                                                            'FaqsTopic To Store Linkage Table'
                                                        );
                                $installer->getConnection()->createTable($store_table);
                                
                                
                               
                                
                                $fme_faq_table = $installer->getTable('fme_faq');                               
                                
                                $installer->getConnection()->addColumn(
                                                                $fme_faq_table,
                                                                'identifier',
                                                                [
                                                                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                                                        'length' => 255,
                                                                        'nullable' => true,
                                                                        'default' => null,
                                                                        'comment' => 'Url Identifier'
                                                                ]                                                
                                                        );
                                
                                $installer->getConnection()->addColumn(
                                                                $fme_faq_table,
                                                                'tags',
                                                                [
                                                                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                                                        'length' => 255,
                                                                        'nullable' => true,
                                                                        'default' => null,
                                                                        'comment' => 'Tags'
                                                                ]                                                
                                                        );
                                
                                $installer->getConnection()->addColumn(
                                                                $fme_faq_table,
                                                                'faqs_topic_id',
                                                                [
                                                                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                                                                        'length' => 255,
                                                                        'nullable' => false,
                                                                        'unsigned' => true,                                                                                                                                                
                                                                        'comment' => 'Topic ID'
                                                                ]                                                
                                                        );
                                
                                $installer->getConnection()->addForeignKey(
                                                                $installer->getFkName('fme_f', 'f_id', 'fme_ft', 'ft_id'),
                                                                $fme_faq_table,
                                                                'faqs_topic_id',
                                                                $installer->getTable('fme_faqs_topic'),
                                                                'faqs_topic_id',
                                                                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE                                                                                                              
                                                        );
                                
                        $installer->endSetup();
                }
                
        }
        
        
        
        
        
}

