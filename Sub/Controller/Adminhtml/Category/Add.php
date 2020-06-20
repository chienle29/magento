<?php


namespace Cate\Sub\Controller\Adminhtml\Category;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Cate\Sub\Model\ResourceModel\Category\CollectionFactory;
use Cate\Sub\Model\CategoryFactory;

class Add extends Action
{
    private $pageFactory;
    private $collectionFactory;
    private $categoryFactory;

    public function __construct(
        Action\Context $context,
        PageFactory $pageFactory,
        CollectionFactory $collectionFactory,
        CategoryFactory $categoryFactory
    )
    {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
        $this->collectionFactory = $collectionFactory;
        $this->categoryFactory = $categoryFactory;
    }

    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        $id = $this->getRequest()->getParam('cate_id');
        $data = $this->categoryFactory->create()->load($id);
        if($data->getId())
        {
            $cateName = $this->collectionFactory->create()->addFieldToSelect('cate_name')
                ->addFieldToFilter('cate_id',$id)->getFirstItem();
            $resultPage->getConfig()->getTitle()->prepend(__($cateName->getCateName()));
        }else{
            $resultPage->getConfig()->getTitle()->prepend(__('Add New Category'));
        }

        return $resultPage;
    }

}
