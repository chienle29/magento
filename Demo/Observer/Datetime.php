<?php


namespace Cate\Demo\Observer;


use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class SetStartDateMaxValue
 * Observes catalog_product_validate_before
 * Purpose: Set max value on start date equal to end date value
 */
class Datetime implements ObserverInterface
{
    /**
     * Execute observer
     * @param EventObserver $observer
     */
    public function execute(EventObserver $observer)
    {
        /** @var \Magento\Catalog\Model\Product $product */
        $product = $observer->getEvent()->getProduct();
        $product->getResource()->getAttribute('publish_start')
            ->setMaxValue($product->getPublishEnd());
    }
}
