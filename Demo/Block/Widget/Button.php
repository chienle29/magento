<?php
namespace Cate\Demo\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Button extends Template implements BlockInterface
{
    protected $_template = "widget/Button.phtml";
}
