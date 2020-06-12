<?php


namespace Cate\Demo\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Load extends AbstractDb
{
    public function _construct()
    {
        $this->_init('magenest_model_load', 'id');
    }
}
