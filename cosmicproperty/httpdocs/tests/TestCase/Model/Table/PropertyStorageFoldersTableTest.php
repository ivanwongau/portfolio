<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PropertyStorageFoldersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PropertyStorageFoldersTable Test Case
 */
class PropertyStorageFoldersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PropertyStorageFoldersTable
     */
    public $PropertyStorageFolders;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.PropertyStorageFolders',
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
        $config = TableRegistry::getTableLocator()->exists('PropertyStorageFolders') ? [] : ['className' => PropertyStorageFoldersTable::class];
        $this->PropertyStorageFolders = TableRegistry::getTableLocator()->get('PropertyStorageFolders', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PropertyStorageFolders);

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
