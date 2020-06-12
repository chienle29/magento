<?php


namespace Cate\Demo\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Catalog\Model\ProductFactory;
use Magento\Eav\Model\Config;

class HideColumn implements ObserverInterface
{
    protected $eavConfig;
    protected $auth;
    protected $flag = 1;
    public function __construct(
        Config $eavConfig,
        \Magento\Backend\Model\Auth\Session $authSession
    )
    {
        $this->eavConfig = $eavConfig;
        $this->auth = $authSession;
    }

    public function execute(Observer $observer)
    {
        //hide custom_magenest column to product grid
        $this->flag;
        if($this->flag === 1){
            $firstName = $this->auth->getUser()->getFirstname();
            $one = substr($firstName,0,1);
            $pattern = "/^[a-mA-M]$/";
            $this->flag = 0;
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
        }

    }
}

