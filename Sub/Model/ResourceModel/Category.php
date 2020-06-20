<?php

namespace Cate\Sub\Model\ResourceModel;

class Category extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct()
    {
        $this->_init('custom_category', 'cate_id');
    }
}
