<?php

use Phalcon\Db\Column;
use Phalcon\Db\Exception;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Migrations\Mvc\Model\Migration;

/**
 * Class TranslationsMigration_100
 */
class TranslationsMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     * @throws Exception
     */
    public function morph(): void
    {
        $this->morphTable('translations', [
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
                    'key',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 155,
                        'after' => 'id'
                    ]
                ),
                new Column(
                    'translation',
                    [
                        'type' => Column::TYPE_TEXT,
                        'notNull' => true,
                        'after' => 'key'
                    ]
                ),
                new Column(
                    'textTypeID',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'translation'
                    ]
                ),
                new Column(
                    'pageID',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'textTypeID'
                    ]
                ),
                new Column(
                    'languageID',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'pageID'
                    ]
                ),
                new Column(
                    'active',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'default' => "1",
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'languageID'
                    ]
                ),
            ],
            'indexes' => [
                new Index('PRIMARY', ['id'], 'PRIMARY'),
                new Index('fk_translations_text_type_idx', ['textTypeID'], ''),
                new Index('fk_translations_page_idx', ['pageID'], ''),
                new Index('fk_translations_language_id_idx', ['languageID'], ''),
            ],
            'references' => [
                new Reference(
                    'fk_translations_language_id',
                    [
                        'referencedSchema' => 'cms_phalcon',
                        'referencedTable' => 'language',
                        'columns' => ['languageID'],
                        'referencedColumns' => ['id'],
                        'onUpdate' => 'NO ACTION',
                        'onDelete' => 'NO ACTION'
                    ]
                ),
                new Reference(
                    'fk_translations_page_id',
                    [
                        'referencedSchema' => 'cms_phalcon',
                        'referencedTable' => 'pages',
                        'columns' => ['pageID'],
                        'referencedColumns' => ['id'],
                        'onUpdate' => 'RESTRICT',
                        'onDelete' => 'RESTRICT'
                    ]
                ),
                new Reference(
                    'fk_translations_text_type_id',
                    [
                        'referencedSchema' => 'cms_phalcon',
                        'referencedTable' => 'text_type',
                        'columns' => ['textTypeID'],
                        'referencedColumns' => ['id'],
                        'onUpdate' => 'NO ACTION',
                        'onDelete' => 'NO ACTION'
                    ]
                ),
            ],
            'options' => [
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '3',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8mb4_0900_ai_ci',
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
        $this->batchInsert('translations', [
            'id',
            'key',
            'translation',
            'textTypeID',
            'pageID',
            'languageID',
            'active',
        ]);
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down(): void
    {
        $this->batchDelete('translations');
    }
}
