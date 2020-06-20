<?php


namespace Cate\Sub\Controller\Adminhtml\Category;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    private $pageFactory;
    CONST ADMIN_RESOURCE = 'Cate_Sub::CategoryList';

    public function __construct(
        Action\Context $context,
        PageFactory $pageFactory
    )
    {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
    }

    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->setActiveMenu('Cate_Sub::CategoryList');
        $resultPage->getConfig()->getTitle()->prepend(__('Category List'));
        return $resultPage;
    }
}
