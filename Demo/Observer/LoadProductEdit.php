<?php


namespace Cate\Demo\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Catalog\Model\ProductFactory;
use Magento\Eav\Model\Config;

class LoadProductEdit implements ObserverInterface
{
    protected $product;
    protected $eavConfig;
    protected $auth;
    public function __construct(
        ProductFactory $productFactory,
        Config $eavConfig,
        \Magento\Backend\Model\Auth\Session $authSession
    )
    {
        $this->product = $productFactory;
        $this->eavConfig = $eavConfig;
        $this->auth = $authSession;
    }

    public function execute(Observer $observer)
    {
        //hide custom_magenest column to product grid
        $firstName = $this->auth->getUser()->getFirstname();
        $one = substr($firstName,0,1);
        $pattern = "/^[a-mA-M]$/";
        if(preg_match($pattern, $one)){
            $data = $this->eavConfig->getAttribute('catalog_product','custom_magenest');
            $data->setData('is_used_in_grid',1);
            $data->setData('is_visible_in_grid',1);
            $data->save();
        }else{
            $data = $this->eavConfig->getAttribute('catalog_product','custom_magenest');
            $data->setData('is_used_in_grid',0);
            $data->setData('is_visible_in_grid',0);
            $data->save();
        }
        //add 'varchar' string to attribute custom_magenest of product
        $product = $observer->getData('collection')->getItems();
        foreach($product as $value){
            if($value->getData('custom_magenest') != ""){
                $name = str_replace("varchar", "", $value->getData('custom_magenest'));
                $value->setData('custom_magenest', $name);
            }
        }
    }
}

