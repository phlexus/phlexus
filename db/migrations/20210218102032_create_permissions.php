<?php
declare(strict_types=1);

namespace Phlexus\Migrations;

use Phinx\Migration\AbstractMigration;

final class CreatePermissions extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('permissions');
        if ($table->exists()) {
            return;
        }
        
        $table->addColumn('profileId', 'integer')
            ->addColumn('resource', 'string', ['limit' => 255])
            ->addColumn('action', 'string', ['limit' => 255])
            ->addIndex(['profileId'])
            ->addForeignKey('profileId', 'profiles', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
            ->create();
    }
}