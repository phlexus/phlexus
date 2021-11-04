<?php
declare(strict_types=1);

namespace Phlexus\Seeds;

use Phinx\Seed\AbstractSeed;

final class AddressTypeSeeder extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'address_type' => 'billing',
            ],
            [
                'id' => 2,
                'address_type' => 'shipment',
            ]
        ];

        $country = $this->table('address_type');
        
        $country->insert($data)->save();
    }
}
