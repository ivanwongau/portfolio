<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LotOwnersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LotOwnersTable Test Case
 */
class LotOwnersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LotOwnersTable
     */
    public $LotOwners;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.LotOwners',
        'app.PropertyMultiOwnerships',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('LotOwners') ? [] : ['className' => LotOwnersTable::class];
        $this->LotOwners = TableRegistry::getTableLocator()->get('LotOwners', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LotOwners);

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
