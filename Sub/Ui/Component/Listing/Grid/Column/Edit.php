<?php

namespace Cate\Sub\Ui\Component\Listing\Grid\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;
/**
 * Description of ProductActions
 *
 * @author dharmendra
 */
class Edit extends Column
{
    /**
     * @var UrlInterface
     */
    private $urlBuilder;

    /** Url Path */
    const URL_PATH_EDIT = 'cataloger/category/add';
    const URL_PATH_VIEW = 'cataloger/category/index';

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = array(),
        UrlInterface $urlBuilder,
        array $data = array())
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return void
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                if (isset($item['cate_id'])) {
                    $item[$name]['edit'] = [
                        'href' => $this->urlBuilder->getUrl(self::URL_PATH_EDIT, ['id' => $item['cate_id']]),
                        'label' => __('Edit')
                    ];
                }
            }
        }
        return $dataSource;
    }
}
