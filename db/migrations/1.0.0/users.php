<?php

use Phalcon\Db\Column;
use Phalcon\Db\Exception;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Migrations\Mvc\Model\Migration;

/**
 * Class UsersMigration_100
 */
class UsersMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     * @throws Exception
     */
    public function morph(): void
    {
        $this->morphTable('users', [
            'columns' => [
                new Column(
                    'id',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'size' => 1,
                        'first' => true
                    ]
                ),
                new Column(
                    'email',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 255,
                        'after' => 'id'
                    ]
                ),
                new Column(
                    'password',
                    [
                        'type' => Column::TYPE_CHAR,
                        'notNull' => true,
                        'size' => 60,
                        'after' => 'email'
                    ]
                ),
                new Column(
                    'hash_code',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => false,
                        'size' => 255,
                        'after' => 'password'
                    ]
                ),
                new Column(
                    'active',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'default' => "1",
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'hash_code'
                    ]
                ),
                new Column(
                    'attempts',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'default' => "0",
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'active'
                    ]
                ),
                new Column(
                    'lastLoginAt',
                    [
                        'type' => Column::TYPE_TIMESTAMP,
                        'notNull' => false,
                        'after' => 'attempts'
                    ]
                ),
                new Column(
                    'lastFailedLoginAt',
                    [
                        'type' => Column::TYPE_TIMESTAMP,
                        'notNull' => false,
                        'after' => 'lastLoginAt'
                    ]
                ),
                new Column(
                    'createdAt',
                    [
                        'type' => Column::TYPE_TIMESTAMP,
                        'default' => "CURRENT_TIMESTAMP",
                        'notNull' => true,
                        'after' => 'lastFailedLoginAt'
                    ]
                ),
                new Column(
                    'modifiedAt',
                    [
                        'type' => Column::TYPE_TIMESTAMP,
                        'default' => "CURRENT_TIMESTAMP",
                        'notNull' => true,
                        'after' => 'createdAt'
                    ]
                ),
                new Column(
                    'profileID',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'modifiedAt'
                    ]
                ),
            ],
            'indexes' => [
                new Index('PRIMARY', ['id'], 'PRIMARY'),
                new Index('profilesID', ['profileID'], ''),
            ],
            'references' => [
                new Reference(
                    'fk_users_profile_id',
                    [
                        'referencedSchema' => 'cms_phalcon',
                        'referencedTable' => 'profiles',
                        'columns' => ['profileID'],
                        'referencedColumns' => ['id'],
                        'onUpdate' => 'NO ACTION',
                        'onDelete' => 'NO ACTION'
                    ]
                ),
            ],
            'options' => [
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '51',
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
        $this->batchInsert('users', [
            'id',
            'email',
            'password',
            'hash_code',
            'active',
            'attempts',
            'lastLoginAt',
            'lastFailedLoginAt',
            'createdAt',
            'modifiedAt',
            'profileID',
        ]);
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down(): void
    {
        $this->batchDelete('users');
    }
}
