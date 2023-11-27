<?php
declare(strict_types=1);

namespace Zaproo\Hobby\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Setup\CustomerSetupFactory;
class AddCustomerHobbyAttribute implements DataPatchInterface, PatchRevertableInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * @var CustomerSetupFactory
     */
    private $customerSetupFactory;
    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CustomerSetupFactory $customerSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->customerSetupFactory = $customerSetupFactory;
    }
    public function apply()
    {
        $customerSetup = $this->customerSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $attributeName = 'hobby';
        $customerSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, $attributeName, [
            'type' => 'static',
            'label' => 'Hobby',
            'input' => 'select',
            'source' => \Zaproo\Hobby\Model\Entity\Attribute\Source\CustomerHobbyOptions::class,
// add url validation rule twice in different format for utilizing by different forms
            'required' => false,
            'system' => false,
            'user_defined' => true,
            'group' => 'General',
            'unique' => true,
            'sort_order' => 300,
            'position' => 300,
        ]);
        $attributeId = $customerSetup->getAttributeId(\Magento\Customer\Model\Customer::ENTITY,
            $attributeName);
        $this->moduleDataSetup->getConnection()
            ->insertMultiple($this->moduleDataSetup->getTable('customer_form_attribute'), [
                ['form_code' => 'adminhtml_customer', 'attribute_id' => $attributeId],
                ['form_code' => 'customer_account_create', 'attribute_id' => $attributeId],
                ['form_code' => 'customer_account_edit', 'attribute_id' => $attributeId]
            ]);
    }
    public static function getDependencies()
    {
        return [];
    }
    public function getAliases()
    {
        return [];
    }
    /**
     * Rollback all changes, done by this patch
     *
     * @return void
     */
    public function revert()
    {}
}
