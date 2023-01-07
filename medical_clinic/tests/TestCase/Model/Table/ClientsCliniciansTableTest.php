<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClientsCliniciansTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClientsCliniciansTable Test Case
 */
class ClientsCliniciansTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ClientsCliniciansTable
     */
    protected $ClientsClinicians;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ClientsClinicians',
        'app.Clients',
        'app.Clinicians',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ClientsClinicians') ? [] : ['className' => ClientsCliniciansTable::class];
        $this->ClientsClinicians = $this->getTableLocator()->get('ClientsClinicians', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ClientsClinicians);

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
