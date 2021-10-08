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
                'password' => '$2y$10$ZmhVa2wyb1Q0WHR4bkhhcugbSDz/dJF6iNLcRhfQOZ/CCtaBHLrtu', // password
                'profileId' => 1,
                'active' => 1,
            ]
        ];

        $users = $this->table('users');
        
        $users->insert($data)->save();
    }
}
