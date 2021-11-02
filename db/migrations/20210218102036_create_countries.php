<?php
declare(strict_types=1);

namespace Phlexus\Migrations;

use Phinx\Migration\AbstractMigration;

final class CreateCountries extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('countries');

        if ($table->exists()) {
            return;
        }

        $table->addColumn('iso', 'string', ['limit' => 3])
            ->addColumn('country', 'char', ['limit' => 255, 'null' => false])
            ->addColumn('active', 'integer', ['limit' => 1, 'default' => 1, 'null' => false])
            ->addColumn('createdAt', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => false])
            ->addColumn('modifiedAt', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => false])
            ->create();
    }
}