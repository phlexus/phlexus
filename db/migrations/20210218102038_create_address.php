<?php
declare(strict_types=1);

namespace Phlexus\Migrations;

use Phinx\Migration\AbstractMigration;

final class CreateAddress extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('address');

        if ($table->exists()) {
            return;
        }

        $table->addColumn('address', 'string', ['limit' => 255])
            ->addColumn('active', 'integer', ['limit' => 1, 'default' => 1, 'null' => false])
            ->addColumn('postCodeID', 'integer', ['null' => false])
            ->addColumn('createdAt', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => false])
            ->addColumn('modifiedAt', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => false])
            ->addIndex(['postCodeID'])
            ->addForeignKey('postCodeID', 'post_code', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
            ->create();
    }
}