<?php
declare(strict_types=1);

namespace Zaproo\Hobby\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Zaproo\Hobby\Model\Entity\Attribute\Source\CustomerHobbyOptions;

class CustomerHobby implements ArgumentInterface
{
    /**
     * @var CustomerHobbyOptions
     */
    protected $customerHobbyOptions;

    /**
     * @param CustomerHobbyOptions $customerHobbyOptions
     */
    public function __construct(CustomerHobbyOptions $customerHobbyOptions)
    {
        $this->customerHobbyOptions = $customerHobbyOptions;
    }

    /**
     * @param $customerData
     * @return bool|string
     */
    public function getCustomerHobby($customerData)
    {
        $attribute = $customerData->getCustomAttribute('hobby');
        if ($attribute) {
            return $this->customerHobbyOptions->getOptionText($attribute->getValue());
        }
        return '';
    }
}
