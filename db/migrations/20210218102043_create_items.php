<?php
declare(strict_types=1);

namespace Phlexus\Migrations;

use Phinx\Migration\AbstractMigration;

final class CreateItems extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('items');
        if ($table->exists()) {
            return;
        }
        
        $table->addColumn('active', 'integer', ['limit' => 1, 'default' => 1, 'null' => false])
            ->addColumn('productId', 'integer')
            ->addColumn('orderId', 'integer')
            ->addIndex(['orderId'])
            ->addIndex(['productId'])
            ->addForeignKey('productId', 'products', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
            ->addForeignKey('orderId', 'orders', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
            ->create();
    }
}