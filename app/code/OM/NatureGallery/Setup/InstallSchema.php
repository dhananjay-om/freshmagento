<?php

namespace Om\NatureGallery\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.0.0') < 0){

		$installer->run('create table om_content(id int not null auto_increment, type varchar(100), title varchar(255), image varchar(100), video_url varchar(255), url varchar(255),section varchar(255), sortorder int(11), status smallint(6), primary key(id))');
$installer->run('create table om_section(id int not null auto_increment, section_id varchar(255), section_title varchar(255), front_title varchar(255), status smallint(6), primary key(id))');


		

		}

        $installer->endSetup();

    }
}