<?php

use Phalcon\Db\Column;
use Phalcon\Db\Exception;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Migrations\Mvc\Model\Migration;

/**
 * Class OrdersMigration_100
 */
class OrdersMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     * @throws Exception
     */
    public function morph(): void
    {
        $this->morphTable('orders', [
            'columns' => [
                new Column(
                    'id',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'size' => 1,
                        'first' => true
                    ]
                ),
                new Column(
                    'hashCode',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 150,
                        'after' => 'id'
                    ]
                ),
                new Column(
                    'paid',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'default' => "0",
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'hashCode'
                    ]
                ),
                new Column(
                    'status',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'default' => "1",
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'paid'
                    ]
                ),
                new Column(
                    'active',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'default' => "1",
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'status'
                    ]
                ),
                new Column(
                    'userID',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'active'
                    ]
                ),
                new Column(
                    'billingID',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'userID'
                    ]
                ),
                new Column(
                    'shipmentID',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'billingID'
                    ]
                ),
                new Column(
                    'paymentMethodID',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'shipmentID'
                    ]
                ),
                new Column(
                    'shippingMethodID',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'paymentMethodID'
                    ]
                ),
                new Column(
                    'createdAt',
                    [
                        'type' => Column::TYPE_TIMESTAMP,
                        'default' => "CURRENT_TIMESTAMP",
                        'notNull' => true,
                        'after' => 'shippingMethodID'
                    ]
                ),
                new Column(
                    'modifiedAt',
                    [
                        'type' => Column::TYPE_TIMESTAMP,
                        'default' => "CURRENT_TIMESTAMP",
                        'notNull' => true,
                        'after' => 'createdAt'
                    ]
                ),
            ],
            'indexes' => [
                new Index('PRIMARY', ['id'], 'PRIMARY'),
                new Index('userID', ['userID'], ''),
                new Index('paymentMethodID', ['paymentMethodID'], ''),
                new Index('shippingMethodID', ['shippingMethodID'], ''),
                new Index('fk_orders_billing_id_idx', ['billingID'], ''),
                new Index('fk_orders_shipment_id_idx', ['shipmentID'], ''),
            ],
            'references' => [
                new Reference(
                    'fk_orders_billing_id',
                    [
                        'referencedSchema' => 'cms_phalcon',
                        'referencedTable' => 'user_address',
                        'columns' => ['billingID'],
                        'referencedColumns' => ['id'],
                        'onUpdate' => 'RESTRICT',
                        'onDelete' => 'RESTRICT'
                    ]
                ),
                new Reference(
                    'fk_orders_payment_method_id',
                    [
                        'referencedSchema' => 'cms_phalcon',
                        'referencedTable' => 'payment_method',
                        'columns' => ['paymentMethodID'],
                        'referencedColumns' => ['id'],
                        'onUpdate' => 'NO ACTION',
                        'onDelete' => 'NO ACTION'
                    ]
                ),
                new Reference(
                    'fk_orders_shipment_id',
                    [
                        'referencedSchema' => 'cms_phalcon',
                        'referencedTable' => 'user_address',
                        'columns' => ['shipmentID'],
                        'referencedColumns' => ['id'],
                        'onUpdate' => 'NO ACTION',
                        'onDelete' => 'NO ACTION'
                    ]
                ),
                new Reference(
                    'fk_orders_shipping_method_id',
                    [
                        'referencedSchema' => 'cms_phalcon',
                        'referencedTable' => 'shipping_method',
                        'columns' => ['shippingMethodID'],
                        'referencedColumns' => ['id'],
                        'onUpdate' => 'NO ACTION',
                        'onDelete' => 'NO ACTION'
                    ]
                ),
                new Reference(
                    'fk_orders_user_id',
                    [
                        'referencedSchema' => 'cms_phalcon',
                        'referencedTable' => 'users',
                        'columns' => ['userID'],
                        'referencedColumns' => ['id'],
                        'onUpdate' => 'NO ACTION',
                        'onDelete' => 'NO ACTION'
                    ]
                ),
            ],
            'options' => [
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '56',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_unicode_ci',
            ],
        ]);
    }

    /**
     * Run the migrations
     *
     * @return void
     */
    public function up(): void
    {
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down(): void
    {
    }
}
