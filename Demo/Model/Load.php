<?php


namespace Cate\Demo\Model;

use Magento\Framework\Model\AbstractModel;

class Load extends AbstractModel
{
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource
        $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb
        $resourceCollection = null,
        array $data = []
    )
    {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }
    public function _construct()
    {
        $this->_init('Cate\Demo\Model\ResourceModel\Load');
    }
}
