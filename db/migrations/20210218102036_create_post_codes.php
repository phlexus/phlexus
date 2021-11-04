<?php
declare(strict_types=1);

namespace Phlexus\Migrations;

use Phinx\Migration\AbstractMigration;

final class CreatePostCodes extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('post_codes');

        if ($table->exists()) {
            return;
        }

        $table->addColumn('post_code', 'char', ['limit' => 60, 'null' => false])
            ->addColumn('active', 'integer', ['limit' => 1, 'default' => 1, 'null' => false])
            ->addColumn('localeID', 'integer', ['null' => false])
            ->addColumn('createdAt', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => false])
            ->addColumn('modifiedAt', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => false])
            ->addIndex(['localeID'])
            ->addForeignKey('localeID', 'local', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
            ->create();
    }
}