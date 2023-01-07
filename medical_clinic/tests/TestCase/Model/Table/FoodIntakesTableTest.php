<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FoodIntakesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FoodIntakesTable Test Case
 */
class FoodIntakesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FoodIntakesTable
     */
    protected $FoodIntakes;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.FoodIntakes',
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
        $config = $this->getTableLocator()->exists('FoodIntakes') ? [] : ['className' => FoodIntakesTable::class];
        $this->FoodIntakes = $this->getTableLocator()->get('FoodIntakes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->FoodIntakes);

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
