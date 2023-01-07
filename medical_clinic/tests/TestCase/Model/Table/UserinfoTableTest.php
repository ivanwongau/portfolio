<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserinfoTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserinfoTable Test Case
 */
class UserinfoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserinfoTable
     */
    protected $Userinfo;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Userinfo',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Userinfo') ? [] : ['className' => UserinfoTable::class];
        $this->Userinfo = $this->getTableLocator()->get('Userinfo', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Userinfo);

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
}
