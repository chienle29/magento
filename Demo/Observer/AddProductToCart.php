<?php

namespace Cate\Demo\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Serialize\Serializer\Json;

class AddProductToCart implements ObserverInterface
{

    protected $serializer;
    protected $dateTime;

    public function __construct(
        Json $json,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime
    )
    {
        $this->serializer = $json;
        $this->dateTime = $dateTime;
    }

    public function execute(Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();
        $additionalOptions = [];
        $dateToTimestamp = date('H:i:s d-m-Y');
        $timeStamp = $this->dateTime->gmtTimestamp($dateToTimestamp);
        $additionalOptions[] = [
            'label' => 'Time Stamp',
            'value' =>  $timeStamp
        ];
        $product->addCustomOption('additional_options', $this->serializer->serialize($additionalOptions));
    }


}
