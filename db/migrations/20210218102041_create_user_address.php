<?php
declare(strict_types=1);

namespace Phlexus\Migrations;

use Phinx\Migration\AbstractMigration;

final class CreateUserAddress extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('user_address');

        if ($table->exists()) {
            return;
        }

        $table->addColumn('active', 'integer', ['limit' => 1, 'default' => 1, 'null' => false])
            ->addColumn('addressID', 'integer', ['null' => false])
            ->addColumn('addressTypeID', 'integer', ['null' => false])
            ->addColumn('createdAt', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => false])
            ->addColumn('modifiedAt', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => false])
            ->addIndex(['addressID'])
            ->addIndex(['addressTypeID'])
            ->addForeignKey('addressID', 'address', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
            ->addForeignKey('addressTypeID', 'address_type', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
            ->create();
    }
}