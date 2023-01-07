<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CliniciansTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CliniciansTable Test Case
 */
class CliniciansTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CliniciansTable
     */
    protected $Clinicians;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Clinicians',
        'app.Users',
        'app.ClinicianQualifications',
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
        $config = $this->getTableLocator()->exists('Clinicians') ? [] : ['className' => CliniciansTable::class];
        $this->Clinicians = $this->getTableLocator()->get('Clinicians', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Clinicians);

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
