<?php
declare(strict_types=1);

namespace Zaproo\Hobby\Model\Entity\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
class CustomerHobbyOptions extends AbstractSource
{
    /**
     * @return array|null
     */
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = [
                ['value' => 'yoga', 'label' => __('Yoga')],
                ['value' => 'traveling', 'label' => __('Traveling')],
                ['value' => 'hiking', 'label' => __('Hiking')],
            ];
        }
        return $this->_options;
    }
}
