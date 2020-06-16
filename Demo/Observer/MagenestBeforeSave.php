<?php


namespace Cate\Demo\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Cate\Demo\Model\MagenestFactory;

class MagenestBeforeSave implements ObserverInterface
{
    private $magenestFactory;

    public function __construct(MagenestFactory $magenestFactory)
    {
        $this->magenestFactory = $magenestFactory;
    }

    public function execute(Observer $observer)
    {
        $data = $observer->getGroup();
        $data->setTitle( $data['title'] . ' magenest');
    }
}
