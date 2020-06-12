<?php


namespace Cate\Demo\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Framework\Event\ObserverInterface;
use Cate\Demo\Model\LoadFactory;

class AfterSave implements ObserverInterface
{
    private $date;
    private $loadFactory;
    public function __construct(DateTime $date, LoadFactory $loadFactory)
    {
        $this->loadFactory = $loadFactory;
        $this->date = $date;
    }

    public function execute(Observer $observer)
    {
//        $time = $this->date->gmtDate('Y-m-d H:i:s');
//        $table = $this->loadFactory->create();
//        $table->setTimeSave($time);
//        $table->save();
    }
}
