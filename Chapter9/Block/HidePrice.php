<?php


namespace Cate\Chapter9\Plugin;

use Magento\Framework\App\Config\ScopeConfigInterface;

class HidePrice
{
    protected $scopeConfig;

    protected $session;
    const OPTIONS = "hide_price/hide_price_group/hide_price_title";

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        \Magento\Customer\Model\Session $session
    )
    {
        $this->scopeConfig = $scopeConfig;
        $this->session = $session;
    }

    public function aroundWrapResult(\Magento\Catalog\Model\Product $subject,callable $proceed, $html, $result)
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE;
        $option = $this->scopeConfig->getValue(self::OPTIONS, $storeScope);
        //check customer is logged
        if($option)
        {
            if(!$this->session->isLoggedIn())
            {
                return '<div class="price-box" ' .
                    'data-role="priceBox" ' .
                    'data-product-id="" ' .
                    'data-price-box="product-id-"' .
                    '>You need is login see price</div>';
            }else{
//                $result = $proceed;
                return $result;
            }
        }else{
            return $result;
        }
    }
}
