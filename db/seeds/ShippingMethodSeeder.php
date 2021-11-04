<?php
declare(strict_types=1);

namespace Phlexus\Seeds;

use Phinx\Seed\AbstractSeed;

final class ShippingMethodSeeder extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'name' => 'online',
            ],
            [
                'id' => 2,
                'name' => 'post',
            ]
        ];

        $s_method = $this->table('shipping_method');
        
        $s_method->insert($data)->save();
    }
}
