<?php


namespace Cate\Demo\Controller\Test;
use Magento\Framework\App\Action\Context;

class Another extends \Magento\Framework\App\Action\Action
{
    protected $my;

    protected $myModel;

    public function __construct(
        Context $context,
        \Cate\Demo\Api\MyInterface $my
    )
    {
        parent::__construct($context);
        $this->my = $my;
    }

    public function execute()
    {
        echo $this->my->foo();
    }
}
