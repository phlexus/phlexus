<?php

use Phalcon\Db\Column;
use Phalcon\Db\Exception;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Migrations\Mvc\Model\Migration;

/**
 * Class UsersMigration_102
 */
class UsersMigration_102 extends Migration
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
                    'userHash',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => false,
                        'size' => 255,
                        'after' => 'password'
                    ]
                ),
                new Column(
                    'hashCode',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => false,
                        'size' => 255,
                        'after' => 'userHash'
                    ]
                ),
                new Column(
                    'attempts',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'default' => "0",
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'hashCode'
                    ]
                ),
                new Column(
                    'profileID',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'attempts'
                    ]
                ),
                new Column(
                    'imageID',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => false,
                        'size' => 1,
                        'after' => 'profileID'
                    ]
                ),
                new Column(
                    'active',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'default' => "1",
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'imageID'
                    ]
                ),
                new Column(
                    'lastLoginAt',
                    [
                        'type' => Column::TYPE_TIMESTAMP,
                        'notNull' => false,
                        'after' => 'active'
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
            ],
            'indexes' => [
                new Index('PRIMARY', ['id'], 'PRIMARY'),
                new Index('profilesID', ['profileID'], ''),
                new Index('fk_users_media_id_idx', ['imageID'], ''),
            ],
            'references' => [
                new Reference(
                    'fk_users_media_id',
                    [
                        'referencedSchema' => 'cms_phalcon',
                        'referencedTable' => 'media',
                        'columns' => ['imageID'],
                        'referencedColumns' => ['id'],
                        'onUpdate' => 'NO ACTION',
                        'onDelete' => 'NO ACTION'
                    ]
                ),
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
                'AUTO_INCREMENT' => '2',
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
            'userHash',
            'hashCode',
            'attempts',
            'profileID',
            'imageID',
            'active',
            'lastLoginAt',
            'lastFailedLoginAt',
            'createdAt',
            'modifiedAt',
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
