<?php
declare(strict_types=1);

namespace Zaproo\Hobby\Block;

use Magento\Framework\View\Element\Template;
use Zaproo\Hobby\Model\Entity\Attribute\Source\CustomerHobbyOptions;

class EditHobby extends Template
{
    /**
     * @var CustomerHobbyOptions
     */
    protected $customerHobbyOptions;

    /**
     * @param CustomerHobbyOptions $customerHobbyOptions
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(CustomerHobbyOptions $customerHobbyOptions, Template\Context $context, array $data = [])
    {
        $this->customerHobbyOptions = $customerHobbyOptions;
        parent::__construct($context, $data);
    }

    /**
     * @return array|null
     */
    public function getHobbyOptions()
    {
        return $this->customerHobbyOptions->getAllOptions();
    }

    /**
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('customer/account/');
    }
}
