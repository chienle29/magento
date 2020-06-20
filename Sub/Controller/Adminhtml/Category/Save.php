<?php


namespace Cate\Sub\Controller\Adminhtml\Category;

use Magento\Backend\App\Action;
use Cate\Sub\Model\CategoryFactory;
use Cate\Sub\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\Message\ManagerInterface;

class Save extends Action
{
    private $categoryFactory;
    private $message;
    private $collectionFactory;

    public function __construct(Action\Context $context, CategoryFactory $categoryFactory, ManagerInterface $manager)
    {
        parent::__construct($context);
        $this->categoryFactory = $categoryFactory;
        $this->message = $manager;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('cate_id');
        $loadId = $this->categoryFactory->create()->load($id);
        $data = $this->getRequest()->getParams();
        if($loadId->getId())
        {
            $table = $this->categoryFactory->create()->load($id);
            $table->setCateName($data['cate_name']);
            $table->setParentId($data['parent_id']);
            $table->save();
            $this->message->addSuccessMessage('Update Category Successfully');
            $this->_redirect('cataloger/category/index');
        }else{
            try {
                $table = $this->categoryFactory->create();
                $table->setCateName($data['cate_name']);
                $table->setParentId($data['parent_id']);
                $table->save();
                $this->message->addSuccessMessage('Add Category Successfully');
                $this->_redirect('cataloger/category/index');
            }catch(\Exception $e){
                $this->message->addErrorMessage($e->getMessage());
                $this->_redirect('cataloger/category/add');
            }
        }
    }
}
