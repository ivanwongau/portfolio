<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClientConditionsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClientConditionsTable Test Case
 */
class ClientConditionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ClientConditionsTable
     */
    protected $ClientConditions;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ClientConditions',
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
        $config = $this->getTableLocator()->exists('ClientConditions') ? [] : ['className' => ClientConditionsTable::class];
        $this->ClientConditions = $this->getTableLocator()->get('ClientConditions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ClientConditions);

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
