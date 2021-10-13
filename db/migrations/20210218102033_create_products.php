<?php
declare(strict_types=1);

namespace Phlexus\Migrations;

use Phinx\Migration\AbstractMigration;

final class CreateProducts extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('products');
        if ($table->exists()) {
            return;
        }
        
        $table->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('price', 'double')
            ->addColumn('active', 'integer', ['limit' => 1, 'default' => 1, 'null' => false])
            ->create();
    }
}