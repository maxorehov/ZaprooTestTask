<?php

declare(strict_types=1);

namespace Zaproo\Hobby\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\CustomerGraphQl\Model\Customer\GetCustomer;
use Zaproo\Hobby\Model\Entity\Attribute\Source\CustomerHobbyOptions;

class GetCustomerHobby implements ResolverInterface
{
    /**
     * @var GetCustomer
     */
    private $getCustomer;

    private $customerHobbyOptions;

    public function __construct(GetCustomer $getCustomer, CustomerHobbyOptions $customerHobbyOptions)
    {
        $this->getCustomer = $getCustomer;
        $this->customerHobbyOptions = $customerHobbyOptions;
    }

    /**
     *@inheirtDoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        $customer = $this->getCustomer->execute($context);
        $customAttribute = $customer->getCustomAttribute('hobby');
        $hobby = null;
        if (!empty($customAttribute)) {
            $hobby = $this->customerHobbyOptions->getOptionText($customAttribute->getValue());
        }
        return [
            'hobby' => $hobby,
        ];
    }
}
