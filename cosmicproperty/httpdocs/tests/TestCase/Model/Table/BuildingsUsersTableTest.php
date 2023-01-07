<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BuildingsUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BuildingsUsersTable Test Case
 */
class BuildingsUsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BuildingsUsersTable
     */
    public $BuildingsUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.BuildingsUsers',
        'app.Users',
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
        $config = TableRegistry::getTableLocator()->exists('BuildingsUsers') ? [] : ['className' => BuildingsUsersTable::class];
        $this->BuildingsUsers = TableRegistry::getTableLocator()->get('BuildingsUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BuildingsUsers);

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
