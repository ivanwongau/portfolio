<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ClientsCliniciansFixture
 */
class ClientsCliniciansFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'client_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'clinician_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'FK_CLIENTS_CLIENTS_CLINICIANS' => ['type' => 'index', 'columns' => ['client_id'], 'length' => []],
            'FK_CLIENTS_CLINICIANS_CLINICIANS' => ['type' => 'index', 'columns' => ['clinician_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'FK_CLIENTS_CLINICIANS_CLINICIANS' => ['type' => 'foreign', 'columns' => ['clinician_id'], 'references' => ['clinicians', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'FK_CLIENTS_CLIENTS_CLINICIANS' => ['type' => 'foreign', 'columns' => ['client_id'], 'references' => ['clients', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci'
        ],
    ];
    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'client_id' => 1,
                'clinician_id' => 1,
            ],
        ];
        parent::init();
    }
}
