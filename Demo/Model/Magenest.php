<?php


namespace Cate\Demo\Model;

use Magento\Framework\Model\AbstractModel;
use Cate\Demo\Api\Data\MagenestInterface;

class Magenest extends AbstractModel implements MagenestInterface
{
    const TITLE = 'title';
    const STATUS = 'status';
    const RULE_TYPE = 'rule_type';
    const CONDITIONS_SERIALIZED = 'conditions_serialized';

    /**
     * Magenest constructor.
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource
        $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb
        $resourceCollection = null,
        array $data = []
    )
    {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    public function _construct()
    {
        $this->_init('Cate\Demo\Model\ResourceModel\Magenest');
    }

    public function getId()
    {
        return $this->_getData('id');
    }
//
//    public function setId($id)
//    {
//        $this->setData('id', $id);
//        return $this;
//    }

    public function setTitle($title)
    {
        $this->setData('title', $title);
        return $this;
    }
    public function getTitle()
    {
        return $this->getData('title');
    }

    public function setStatus($status)
    {
        $this->setData('status', $status);
        return $this;
    }
    public function getStatus()
    {
        return $this->getData('status');
    }

    public function setRuleType($ruleType)
    {
       $this->setData('rule_type', $ruleType);
        return $this;
    }

    public function getRuleType()
    {
        return $this->getData('rule_type');
    }

    public function setConditionsSerialized($conditionsSerialized)
    {
        $this->setData('conditions_serialized', $conditionsSerialized);
        return $this;
    }

    public function getConditionsSerialized()
    {
        return $this->getData('conditions_serialized');
    }

    public function getCustomAttributes(){
        // TODO: Implement setCustomAttribute() method.
    }
    public function setCustomAttribute($attributeCode, $attributeValue)
    {
        // TODO: Implement setCustomAttribute() method.
    }
    public function setCustomAttributes(array $attributes)
    {
        // TODO: Implement setCustomAttributes() method.
    }
    public function getCustomAttribute($attributeCode)
    {
        // TODO: Implement getCustomAttribute() method.
    }
}
