<?php

namespace Cate\Demo\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\Serialize\Serializer\Serialize;
use Magento\Customer\Model\ResourceModel\Group\CollectionFactory;

class UpgradeData implements UpgradeDataInterface
{
    protected $magenestFactory;
    protected $json;
    protected $serialize;
    protected $categorySetupFactory;
    protected $customer;

    public function __construct(
        \Cate\Demo\Model\MagenestFactory $magenestFactory,
        Json $json,
        Serialize $serialize,
        \Magento\Catalog\Setup\CategorySetupFactory $categorySetupFactory,
        CollectionFactory $customerFactory
    )
    {
        $this->magenestFactory = $magenestFactory;
        $this->json = $json;
        $this->serialize = $serialize;
        $this->categorySetupFactory = $categorySetupFactory;
        $this->customer = $customerFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        //get current version
//        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
//        $productMetadata = $objectManager->get('Magento\Framework\App\ProductMetadataInterface');
//        $version = $productMetadata->getVersion();
//        $currentVersion = (float)$version;
//        //get data column conditions_serialized
//        $data = $this->magenestFactory->create()->getCollection()->addFieldToSelect(array('id', 'conditions_serialized'));
//        //compare
//        foreach ($data->getData() as $value) {
//            $isSerialized = $this->isSerialized($value['conditions_serialized']);
//            $arr = $isSerialized ? $this->serialize->unserialize($value['conditions_serialized']) : $this->json->unserialize($value['conditions_serialized']);
//            $table = $this->magenestFactory->create()->load($value['id']);
//
//            if ($currentVersion < 2.2) {
//                $table->setConditionsSerialized($this->json->serialize($arr));
//            } else {
//                $table->setConditionsSerialized($this->serialize->serialize($arr));
//            }
//            $table->save();
//        }
        $categorySetup = $this->categorySetupFactory->create(['setup' => $setup]);
        //create product attribute


        if (version_compare($context->getVersion(), '1.2.6') < 0) {

            $customerData = $this->customer->create()->getData();
            $arr = "";
            foreach($customerData as $value)
            {
                $arr .= $value['customer_group_code'].",";
            }
            $arr = trim($arr);
            $arr = explode(",",$arr);


            $entityTypeId = $categorySetup->getEntityTypeId(\Magento\Catalog\Model\Product::ENTITY);


            $categorySetup->addAttribute($entityTypeId, 'Customer_Groups', array(
                'type' => 'varchar',
                'label' => 'Customer Groups',
                'input' => 'select',
                'required' => true,
                'global' => 'store',
                'visible_on_front' => false,
                'apply_to' => 'simple,configurable,virtual,bundle,downloadable',
                'unique' => false,
                'group' => 'Magenest',
                'is_used_in_grid' => false,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => true,
                'visible' => true,
                'user_defined' => false,
                'searchable' => false,
                'filterable' => false,
                'comparable' => true,
                'is_html_allowed_on_front' => false,
                'used_for_sort_by' => true,
                'sort_order' => 10,
                'option' => ['values' => $arr],
            ));

            $categorySetup->addAttribute($entityTypeId, 'custom_magenest', array(
                'type' => 'varchar',
                'label' => 'Custom Magenest',
                'input' => 'text',
                'required' => true,
                'global' => 'store',
                'visible_on_front' => false,
                'apply_to' => 'simple,configurable,virtual,bundle,downloadable',
                'unique' => false,
                'group' => 'Magenest',
                'is_used_in_grid' => false,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => true,
                'visible' => true,
                'user_defined' => false,
                'searchable' => true,
                'filterable' => true,
                'comparable' => true,
                'is_html_allowed_on_front' => false,
                'used_for_sort_by' => true,
                'sort_order' => 9,
            ));
        }



        /** @var EavSetup $eavSetup */

        //associate these attributes with new product type
        $fieldList = [
            'price',
            'special_price',
            'special_from_date',
            'special_to_date',
            'minimal_price',
            'cost',
            'tier_price',
            'weight',
            'custom_magenest',
            'Customer_Groups'
        ];
        foreach ($fieldList as $field) {
            $applyTo = explode(
                ',',
                $categorySetup->getAttribute(\Magento\Catalog\Model\Product::ENTITY, $field, 'apply_to')
            );
            if (!in_array('custom_product_type_code', $applyTo)) {
                $applyTo[] = 'custom_product_type_code';
                $categorySetup->updateAttribute(
                    \Magento\Catalog\Model\Product::ENTITY,
                    $field,
                    'apply_to',
                    implode(',', $applyTo)
                );
            }
        }

        $applyTo = explode(',', $categorySetup->getAttribute(\Magento\Catalog\Model\Product::ENTITY, 'cost', 'apply_to'));
        unset($applyTo[array_search('custom_product_type_code', $applyTo)]);
        $categorySetup->updateAttribute(\Magento\Catalog\Model\Product::ENTITY, 'cost', 'apply_to', implode(',', $applyTo));


   }

    //Is the serialized
    private function isSerialized($value)
    {
        return (boolean)preg_match('/^((s|i|d|b|a|O|C):|N;)/', $value);
    }
}
