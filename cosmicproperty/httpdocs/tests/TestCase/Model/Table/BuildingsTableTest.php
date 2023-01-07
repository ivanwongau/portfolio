<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BuildingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BuildingsTable Test Case
 */
class BuildingsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BuildingsTable
     */
    public $Buildings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Buildings',
        'app.Users',
        'app.MultiOwnerships',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Buildings') ? [] : ['className' => BuildingsTable::class];
        $this->Buildings = TableRegistry::getTableLocator()->get('Buildings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Buildings);

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
