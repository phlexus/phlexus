<?php
declare(strict_types=1);

namespace Phlexus\Seeds;

use Phinx\Seed\AbstractSeed;
use Phlexus\Modules\BaseUser\Models\Profiles;

final class UsersSeeder extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@phlexus.io',
                'password' => '$2y$14$dTFFQWt0L1Y3UjJSeW9EVuYBd0PALiWvzC8s99h.o.mYDOa/3JF2m',
                'profilesId' => Profiles::ADMIN,
                'active' => 1,
            ]
        ];

        $posts = $this->table('users');
        
        $posts->insert($data)->save();
    }
}
