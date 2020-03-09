<?php

namespace OM\Press\Setup;
 
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
 
class InstallData implements InstallDataInterface
{
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();
        $tableName = $setup->getTable('om_press');
        if ($setup->getConnection()->isTableExists($tableName) == true) {
            $data = [
                        [
                            'title' => 'Excelent Extension',
                            'text' => 'Very good Press extension for magento 2 with multi store support.',
                            'name' => 'Smith',                       
                            'created_at' => date('Y-m-d H:i:s'),
                            'image' => 'press/test_1.jpg',
                            'store_id' => 0,
                            'sort_order' => 1,
                            'status' => 1,
                        ],
    					[
                            'title' => 'Good Extension',
                            'text' => 'Very good Press extension for magento 2.',
                            'name' => 'John',                        
                            'created_at' => date('Y-m-d H:i:s'),
                            'image' => 'press/test_1.jpg',
                            'store_id' => 0,
                            'sort_order' => 1,
                            'status' => 1,
                        ]
                    ];
            foreach ($data as $item) {
                $setup->getConnection()->insert($tableName, $item);
            }
        }
 
        $setup->endSetup();
    }
}