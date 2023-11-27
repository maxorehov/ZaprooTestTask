<?php
declare(strict_types=1);

namespace Zaproo\Hobby\Controller\Edit;

use Magento\Customer\Controller\Account\EditPost;

class Save extends EditPost
{
    /**
     * @return \Magento\Framework\Controller\Result\Redirect|void
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        $redirect = $this->resultRedirectFactory->create();
        if ($this->session->isLoggedIn()) {
            $customer = $this->customerRepository->getById($this->session->getCustomerId());
            $hobby = $this->getRequest()->getParam('hobby');
            $customer->setCustomAttribute('hobby', $hobby);
            try {
                $this->customerRepository->save($customer);
                $this->messageManager->addSuccessMessage(__('You changed customer hobby'));
                return $redirect->setPath('customer/account');
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('We can\'t save the customer.'));
            }

        } else {
            return $redirect->setPath('customer/account/login');
        }
    }
}
