<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EducationTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EducationTable Test Case
 */
class EducationTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EducationTable
     */
    protected $Education;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Education',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Education') ? [] : ['className' => EducationTable::class];
        $this->Education = $this->getTableLocator()->get('Education', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Education);

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
