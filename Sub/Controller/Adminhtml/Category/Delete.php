<?php


namespace Cate\Sub\Controller\Adminhtml\Category;

use Magento\Backend\App\Action;
use Magento\Framework\Message\ManagerInterface;
use Magento\Ui\Component\MassAction\Filter;
use Cate\Sub\Model\ResourceModel\Category\CollectionFactory;
use Magento\Catalog\Api\ProductRepositoryInterface;

class Delete extends Action
{
    private $message;
    private $filter;
    private $cateCollectionFactory;
    private $productRepository;

    public function __construct(
        Action\Context $context,
        CollectionFactory $CollectionFactory,
        ManagerInterface $message,
        Filter $filter,
        ProductRepositoryInterface $productRepository = null
    )
    {
        parent::__construct($context);
        $this->message = $message;
        $this->cateCollectionFactory = $CollectionFactory;
        $this->filter = $filter;
        $this->productRepository = $productRepository ?:
            \Magento\Framework\App\ObjectManager::getInstance()->create(ProductRepositoryInterface::class);
    }

    public function execute()
    {
        $total = 0;
        $collection = $this->filter->getCollection($this->cateCollectionFactory->create());
        foreach ($collection->getItems() as $value)
        {
            $value->delete();
            $total ++;
        }
        $this->getMessageManager()->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $total));
        $this->_redirect('cataloger/category/index');
    }
}
