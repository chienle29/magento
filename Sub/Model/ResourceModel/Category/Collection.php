<?php

namespace Cate\Sub\Model\ResourceModel\Category;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = "cate_id";
    public function _construct()
    {
        $this->_init('Cate\Sub\Model\Category', 'Cate\Sub\Model\ResourceModel\Category');
    }

}
