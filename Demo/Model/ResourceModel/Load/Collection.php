<?php


namespace Cate\Demo\Model\ResourceModel\Load;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = "id";
    public function _construct()
    {
        $this->_init('Cate\Demo\Model\Load', 'Cate\Demo\Model\ResourceModel\Load');
    }
}
