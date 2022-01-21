<?php

use Phalcon\Db\Column;
use Phalcon\Db\Exception;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Migrations\Mvc\Model\Migration;

/**
 * Class PhinxlogMigration_100
 */
class PhinxlogMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     * @throws Exception
     */
    public function morph(): void
    {
        $this->morphTable('phinxlog', [
            'columns' => [
                new Column(
                    'version',
                    [
                        'type' => Column::TYPE_BIGINTEGER,
                        'notNull' => true,
                        'size' => 1,
                        'first' => true
                    ]
                ),
                new Column(
                    'migration_name',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => false,
                        'size' => 100,
                        'after' => 'version'
                    ]
                ),
                new Column(
                    'start_time',
                    [
                        'type' => Column::TYPE_TIMESTAMP,
                        'notNull' => false,
                        'after' => 'migration_name'
                    ]
                ),
                new Column(
                    'end_time',
                    [
                        'type' => Column::TYPE_TIMESTAMP,
                        'notNull' => false,
                        'after' => 'start_time'
                    ]
                ),
                new Column(
                    'breakpoint',
                    [
                        'type' => Column::TYPE_TINYINTEGER,
                        'default' => "0",
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'end_time'
                    ]
                ),
            ],
            'indexes' => [
                new Index('PRIMARY', ['version'], 'PRIMARY'),
            ],
            'options' => [
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_unicode_ci',
            ],
        ]);
    }

    /**
     * Run the migrations
     *
     * @return void
     */
    public function up(): void
    {
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down(): void
    {
    }
}
