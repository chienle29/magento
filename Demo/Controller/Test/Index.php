<?php

namespace Cate\Demo\Controller\Test;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\Serialize\Serializer\Serialize;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $magenestFactory;
    protected $json;
    protected $serialize;

    public function __construct(
        Context $context,
        \Cate\Demo\Model\MagenestFactory $magenestFactory,
        Json $json,
        Serialize $serialize
    )
    {
        parent::__construct($context);
        $this->magenestFactory = $magenestFactory;
        $this->json = $json;
        $this->serialize = $serialize;
    }

    public function execute()
    {
        //get current version
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $productMetadata = $objectManager->get('Magento\Framework\App\ProductMetadataInterface');
        $version = $productMetadata->getVersion();
        $currentVersion = (float)$version;
        //get data column conditions_serialized
        $data = $this->magenestFactory->create()->getCollection()->addFieldToSelect(array('id', 'conditions_serialized'));
        //compare
        foreach ($data->getData() as $value) {
            $isSerialized = $this->isSerialized($value['conditions_serialized']);
            $arr = $isSerialized ? $this->serialize->unserialize($value['conditions_serialized']) : $this->json->unserialize($value['conditions_serialized']);
            $table = $this->magenestFactory->create()->load($value['id']);

            if ($currentVersion < 2.2) {
                $table->setConditionsSerialized($this->json->serialize($arr));
            } else {
                $table->setConditionsSerialized($this->serialize->serialize($arr));
            }
            $table->save();
        }
        $obj = \Magento\Framework\App\ObjectManager::getInstance();
        $abc = $obj->create('\Cate\Demo\Model\MagenestFactory');
        $items =  $abc->create()->getCollection()->addFieldToFilter('status','pending')->getItems();
        foreach($items as $value){
            print_r($value->getData());
        }


    }

    //Is the serialized
    private function isSerialized($value)
    {
        return (boolean)preg_match('/^((s|i|d|b|a|O|C):|N;)/', $value);
    }

}
