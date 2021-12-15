<?php
declare(strict_types=1);

namespace Phlexus\Migrations;

use Phinx\Migration\AbstractMigration;

final class CreateUsers extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('users');

        if ($table->exists()) {
            return;
        }

        $table->addColumn('email', 'string', ['limit' => 255])
            ->addColumn('password', 'char', ['limit' => 60, 'null' => false])
            ->addColumn('hash_code', 'char', ['limit' => 255])
            ->addColumn('active', 'integer', ['limit' => 1, 'default' => 1, 'null' => false])
            ->addColumn('attempts', 'integer', ['default' => 0, 'null' => false])
            ->addColumn('profileId', 'integer', ['null' => false])
            ->addColumn('lastLogin', 'timestamp', ['null' => true])
            ->addColumn('lastFailedLogin', 'timestamp', ['null' => true])
            ->addColumn('createdAt', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => false])
            ->addColumn('modifiedAt', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => false])
            ->addIndex(['profileId'])
            ->addForeignKey('profileId', 'profiles', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
            ->create();
    }
}