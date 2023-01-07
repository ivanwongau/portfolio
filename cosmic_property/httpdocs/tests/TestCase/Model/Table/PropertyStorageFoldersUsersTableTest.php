<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PropertyStorageFoldersUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PropertyStorageFoldersUsersTable Test Case
 */
class PropertyStorageFoldersUsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PropertyStorageFoldersUsersTable
     */
    public $PropertyStorageFoldersUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.PropertyStorageFoldersUsers',
        'app.Users',
        'app.PropertyStorageFolders',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PropertyStorageFoldersUsers') ? [] : ['className' => PropertyStorageFoldersUsersTable::class];
        $this->PropertyStorageFoldersUsers = TableRegistry::getTableLocator()->get('PropertyStorageFoldersUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PropertyStorageFoldersUsers);

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
