<?php
declare(strict_types=1);

namespace Phlexus\Migrations;

use Phinx\Migration\AbstractMigration;

final class CreateOrders extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('orders');

        if ($table->exists()) {
            return;
        }

        $table->addColumn('active', 'integer', ['limit' => 1, 'default' => 1, 'null' => false])
            ->addColumn('userId', 'integer', ['null' => false])
            ->addColumn('billingID', 'integer', ['null' => false])
            ->addColumn('shipmentID', 'integer', ['null' => false])
            ->addColumn('paymentMethodID', 'integer', ['null' => false])
            ->addColumn('shippingMethodID', 'integer', ['null' => false])
            ->addColumn('createdAt', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => false])
            ->addColumn('modifiedAt', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => false])
            ->addIndex(['userId'])
            ->addIndex(['billingID'])
            ->addIndex(['shipmentID'])
            ->addIndex(['paymentMethodID'])
            ->addIndex(['shippingMethodID'])
            ->addForeignKey('userId', 'users', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
            ->addForeignKey('billingID', 'user_address', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
            ->addForeignKey('shipmentID', 'user_address', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
            ->addForeignKey('paymentMethodID', 'payment_method', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
            ->addForeignKey('shippingMethodID', 'shippind_method', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
            ->create();
    }
}