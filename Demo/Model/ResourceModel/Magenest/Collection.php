<?php


namespace Cate\Demo\Model\ResourceModel\Magenest;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = "id";
    public function _construct()
    {
        $this->_init('Cate\Demo\Model\Magenest', 'Cate\Demo\Model\ResourceModel\Magenest');
    }
}
