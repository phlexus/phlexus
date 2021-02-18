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
            ->addColumn('password', 'char', ['limit' => 60])
            ->addColumn('active', 'integer', ['limit' => 1, 'default' => 1, 'null' => false])
            ->addColumn('profileId', 'integer')
            ->addIndex(['profileId'])
            ->addForeignKey('profileId', 'profiles', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
            ->create();
    }
}