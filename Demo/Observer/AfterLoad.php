<?php


namespace Cate\Demo\Observer;

use \Magento\Framework\Stdlib\DateTime\DateTime;
use Cate\Demo\Model\LoadFactory;

class AfterLoad implements \Magento\Framework\Event\ObserverInterface
{
    private $date;
    private $loadFactory;
    public function __construct(DateTime $dateTime, LoadFactory $loadFactory)
    {
        $this->date = $dateTime;
        $this->loadFactory = $loadFactory;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $time = $this->date->gmtDate('Y-m-d H:i:s');
        $table = $this->loadFactory->create();
        $table->setTimeLoad($time);
        $table->save();
    }
}
