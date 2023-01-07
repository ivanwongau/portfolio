<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GoalsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GoalsTable Test Case
 */
class GoalsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\GoalsTable
     */
    protected $Goals;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Goals',
        'app.Clients',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Goals') ? [] : ['className' => GoalsTable::class];
        $this->Goals = $this->getTableLocator()->get('Goals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Goals);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
