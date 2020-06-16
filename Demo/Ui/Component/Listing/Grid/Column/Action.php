<?php

namespace Cate\Demo\Ui\Component\Listing\Grid\Column;

use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class Actions
 */
class Action extends Column
{
    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                // here we can also use the data from $item to configure some parameters of an action URL
                $item[$this->getData('name')] = [
                    'edit' => [
                        'href' => 'http://chien.lc/admin/magenest/rules/add/id/'.$item["id"],
                        'label' => __('Edit')
                    ]
                ];
            }
        }

        return $dataSource;
    }
}
