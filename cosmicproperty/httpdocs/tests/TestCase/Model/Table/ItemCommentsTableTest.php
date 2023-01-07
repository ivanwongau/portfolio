<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemCommentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemCommentsTable Test Case
 */
class ItemCommentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemCommentsTable
     */
    public $ItemComments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ItemComments',
        'app.ItemMaintenances',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ItemComments') ? [] : ['className' => ItemCommentsTable::class];
        $this->ItemComments = TableRegistry::getTableLocator()->get('ItemComments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemComments);

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
