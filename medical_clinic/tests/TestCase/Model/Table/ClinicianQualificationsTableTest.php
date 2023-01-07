<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClinicianQualificationsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClinicianQualificationsTable Test Case
 */
class ClinicianQualificationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ClinicianQualificationsTable
     */
    protected $ClinicianQualifications;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ClinicianQualifications',
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
        $config = $this->getTableLocator()->exists('ClinicianQualifications') ? [] : ['className' => ClinicianQualificationsTable::class];
        $this->ClinicianQualifications = $this->getTableLocator()->get('ClinicianQualifications', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ClinicianQualifications);

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
