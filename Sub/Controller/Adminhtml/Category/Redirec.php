<?php


namespace Cate\Sub\Controller\Adminhtml\Category;

use Magento\Backend\App\Action;

class Redirec extends Action
{
    public function __construct(Action\Context $context)
    {
        parent::__construct($context);
    }

    public function execute()
    {
        $this->_forward('add');
    }
}
