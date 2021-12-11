<?php
declare(strict_types=1);

namespace Phlexus\Seeds;

use Phinx\Seed\AbstractSeed;

final class PaymentMethodSeeder extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'name' => 'MB',
            ]
        ];

        $p_method = $this->table('payment_method');
        
        $p_method->insert($data)->save();
    }
}
