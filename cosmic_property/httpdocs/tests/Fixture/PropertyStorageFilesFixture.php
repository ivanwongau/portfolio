<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PropertyStorageFilesFixture
 */
class PropertyStorageFilesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'file_name' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'uploaded_by' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'uploaded_date' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'file_details' => ['type' => 'string', 'length' => 500, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'folder_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'file_path' => ['type' => 'string', 'length' => 8000, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'FK_property_storage_files_users' => ['type' => 'index', 'columns' => ['uploaded_by'], 'length' => []],
            'FK_property_storage_files_property_storage_folders' => ['type' => 'index', 'columns' => ['folder_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'FK_property_storage_files_property_storage_folders' => ['type' => 'foreign', 'columns' => ['folder_id'], 'references' => ['property_storage_folders', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'FK_property_storage_files_users' => ['type' => 'foreign', 'columns' => ['uploaded_by'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'file_name' => 'Lorem ipsum dolor sit amet',
                'uploaded_by' => 1,
                'uploaded_date' => '2021-09-20',
                'file_details' => 'Lorem ipsum dolor sit amet',
                'folder_id' => 1,
                'file_path' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
