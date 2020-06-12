<?php


namespace Cate\Demo\Model\ResourceModel;


class Magenest extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct()
    {
        $this->_init('magenest_rules', 'id');
    }
}
