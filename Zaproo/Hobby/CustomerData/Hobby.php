<?php
declare(strict_types=1);

namespace Zaproo\Hobby\CustomerData;

use Magento\Customer\CustomerData\SectionSourceInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Session;
use Zaproo\Hobby\Model\Entity\Attribute\Source\CustomerHobbyOptions;


class Hobby implements SectionSourceInterface
{

    /**
     * @var CustomerHobbyOptions
     */
    protected $customerHobbyOptions;

    /**
     * @var CustomerRepositoryInterface
     */
    protected $customerRepository;

    /**
     * @var Session
     */
    protected $session;

    /**
     * @param CustomerRepositoryInterface $customerRepository
     * @param Session $session
     */
    public function __construct(CustomerRepositoryInterface $customerRepository, Session $session, CustomerHobbyOptions $customerHobbyOptions)
    {
        $this->customerRepository = $customerRepository;
        $this->session = $session;
        $this->customerHobbyOptions = $customerHobbyOptions;
    }

    /**
     * @return array
     */
    public function getSectionData()
    {
        return [
            'hobby' => $this->getCustomerHobby()
        ];
    }

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    private function getCustomerHobby()
    {
        $customer = $this->customerRepository->getById($this->session->getCustomerId());
        $customAttribute = $customer->getCustomAttribute('hobby');
        if (!empty($customAttribute)) {
            return $this->customerHobbyOptions->getOptionText($customAttribute->getValue());
        }
    }
}
