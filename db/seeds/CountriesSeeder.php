<?php
declare(strict_types=1);

namespace Phlexus\Seeds;

use Phinx\Seed\AbstractSeed;

final class CountriesSeeder extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'iso' => 'PT',
                'country' => 'Portugal',
                'active' => 1,
            ]
        ];

        $country = $this->table('countries');
        
        $country->insert($data)->save();
    }
}
