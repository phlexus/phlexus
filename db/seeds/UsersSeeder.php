<?php
declare(strict_types=1);

namespace Phlexus\Seeds;

use Phinx\Seed\AbstractSeed;

final class UsersSeeder extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'email' => 'admin@phlexus.io',
                'password' => '$2y$14$dTFFQWt0L1Y3UjJSeW9EVuYBd0PALiWvzC8s99h.o.mYDOa/3JF2m',
                'profileId' => 1,
                'active' => 1,
            ]
        ];

        $users = $this->table('users');
        
        $users->insert($data)->save();
    }
}
