<?php
declare(strict_types=1);

namespace Phlexus\Seeds;

use Phinx\Seed\AbstractSeed;

final class PermissionsSeeder extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'profileId' => 1,
                'resource' => 'baseuser_auth',
                'action' => 'dologin',
            ],
            [
                'id' => 2,
                'profileId' => 1,
                'resource' => 'baseuser_index',
                'action' => 'index',
            ],
            [
                'id' => 3,
                'profileId' => 3,
                'resource' => 'baseuser_auth',
                'action' => 'logout',
            ],
            [
                'id' => 4,
                'profileId' => 1,
                'resource' => 'user_users',
                'action' => 'index',
            ],
        ];
        
        $posts = $this->table('permissions');

        $posts->insert($data)->save();
    }
}