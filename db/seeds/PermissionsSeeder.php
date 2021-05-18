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
                'profileId' => 3,
                'resource' => 'baseuser_auth',
                'action' => 'create',
            ],
            [
                'id' => 2,
                'profileId' => 3,
                'resource' => 'baseuser_auth',
                'action' => 'docreate',
            ],
            [
                'id' => 3,
                'profileId' => 3,
                'resource' => 'baseuser_auth',
                'action' => 'login',
            ],
            [
                'id' => 4,
                'profileId' => 3,
                'resource' => 'baseuser_auth',
                'action' => 'remind',
            ],
            [
                'id' => 5,
                'profileId' => 3,
                'resource' => 'baseuser_auth',
                'action' => 'dologin',
            ],
            [
                'id' => 6,
                'profileId' => 3,
                'resource' => 'baseuser_auth',
                'action' => 'doremind',
            ],
            [
                'id' => 7,
                'profileId' => 3,
                'resource' => 'baseuser_auth',
                'action' => 'recover',
            ],
            [
                'id' => 8,
                'profileId' => 3,
                'resource' => 'baseuser_auth',
                'action' => 'dorecover',
            ],
            [
                'id' => 9,
                'profileId' => 1,
                'resource' => 'baseuser_index',
                'action' => 'index',
            ],
            [
                'id' => 10,
                'profileId' => 1,
                'resource' => 'baseuser_auth',
                'action' => 'logout',
            ],
            [
                'id' => 11,
                'profileId' => 1,
                'resource' => 'user_users',
                'action' => 'index',
            ],
            [
                'id' => 12,
                'profileId' => 1,
                'resource' => 'user_users',
                'action' => 'create',
            ],
            [
                'id' => 13,
                'profileId' => 1,
                'resource' => 'user_users',
                'action' => 'edit',
            ],
            [
                'id' => 14,
                'profileId' => 1,
                'resource' => 'user_users',
                'action' => 'view',
            ],
            [
                'id' => 15,
                'profileId' => 1,
                'resource' => 'user_users',
                'action' => 'save',
            ],
            [
                'id' => 16,
                'profileId' => 1,
                'resource' => 'user_users',
                'action' => 'delete',
            ],
        ];
        
        $permissions = $this->table('permissions');

        $permissions->insert($data)->save();
    }
}