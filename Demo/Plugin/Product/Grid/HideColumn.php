<?php


namespace Cate\Demo\Plugin\Product\Grid;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class HideColumn extends Column
{

    public function afterPrepareDataSource(\Magento\Catalog\Ui\Component\Listing\Columns\ProductActions $subject, array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $storeId = $this->context->getFilterParam('store_id');
            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')]['edit'] = [
                    'label' => __('Edit'),
                    'hidden' => true,
                    '__disableTmpl' => true
                ];
            }
        }
        return $dataSource;
    }
}
