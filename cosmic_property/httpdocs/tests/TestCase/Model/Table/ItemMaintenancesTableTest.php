<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemMaintenancesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemMaintenancesTable Test Case
 */
class ItemMaintenancesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemMaintenancesTable
     */
    public $ItemMaintenances;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ItemMaintenances',
        'app.Properties',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ItemMaintenances') ? [] : ['className' => ItemMaintenancesTable::class];
        $this->ItemMaintenances = TableRegistry::getTableLocator()->get('ItemMaintenances', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemMaintenances);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
