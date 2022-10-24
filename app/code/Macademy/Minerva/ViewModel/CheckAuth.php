<?php declare(strict_types=1);

namespace Macademy\Minerva\ViewModel;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class CheckAuth implements ArgumentInterface
{
    private CustomerRepositoryInterface $customerRepository;

    public function __construct(
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->customerRepository = $customerRepository;
    }

    public function getCustomerById($customer_id): string
    {
        if ($customer_id == 'None') {
            return '-';
        } else {
            $customer = $this->customerRepository->getById($customer_id);
            return $customer->getFirstname();
        }
    }

    public function getUserInfo(): bool
    {
        return array_key_exists('customer_id', $_SESSION['customer_base']);
    }

    public function getCurrentUser(): ?int
    {
        if ($this->getUserInfo()) {
            return $_SESSION['customer_base']['customer_id'];
        }
        return null;
    }
}
