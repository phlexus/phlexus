<?php
declare(strict_types=1);

namespace Phlexus\Migrations;

use Phinx\Migration\AbstractMigration;

final class CreateAddressType extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('address_type');

        if ($table->exists()) {
            return;
        }

        $table->addColumn('address_type', 'string', ['limit' => 255])
            ->addColumn('active', 'integer', ['limit' => 1, 'default' => 1, 'null' => false])
            ->create();
    }
}