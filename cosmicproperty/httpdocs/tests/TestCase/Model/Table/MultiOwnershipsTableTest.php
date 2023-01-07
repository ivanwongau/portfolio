<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MultiOwnershipsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MultiOwnershipsTable Test Case
 */
class MultiOwnershipsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MultiOwnershipsTable
     */
    public $MultiOwnerships;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.MultiOwnerships',
        'app.Buildings',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MultiOwnerships') ? [] : ['className' => MultiOwnershipsTable::class];
        $this->MultiOwnerships = TableRegistry::getTableLocator()->get('MultiOwnerships', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MultiOwnerships);

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
