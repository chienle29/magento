<?php

namespace Cate\Demo\Model\Product\Type;

class Type extends \Magento\Catalog\Model\Product\Type\Virtual
{
    const TYPE_ID = 'custom_product_type_code';

    /**
     * {@inheritdoc}
     */
    public function deleteTypeSpecificData(\Magento\Catalog\Model\Product $product)
    {
        // method intentionally empty
    }
}
