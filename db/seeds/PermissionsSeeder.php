<?php
declare(strict_types=1);

namespace Phlexus\Seeds;

use Phinx\Seed\AbstractSeed;

final class PermissionsSeeder extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'ProfilesSeeder',
        ];
    }

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
                'action' => 'activate',
            ],
            [
                'id' => 4,
                'profileId' => 3,
                'resource' => 'baseuser_auth',
                'action' => 'login',
            ],
            [
                'id' => 5,
                'profileId' => 3,
                'resource' => 'baseuser_auth',
                'action' => 'remind',
            ],
            [
                'id' => 6,
                'profileId' => 3,
                'resource' => 'baseuser_auth',
                'action' => 'dologin',
            ],
            [
                'id' => 7,
                'profileId' => 3,
                'resource' => 'baseuser_auth',
                'action' => 'doremind',
            ],
            [
                'id' => 8,
                'profileId' => 3,
                'resource' => 'baseuser_auth',
                'action' => 'recover',
            ],
            [
                'id' => 9,
                'profileId' => 3,
                'resource' => 'baseuser_auth',
                'action' => 'dorecover',
            ],
            [
                'id' => 10,
                'profileId' => 1,
                'resource' => 'baseuser_index',
                'action' => 'index',
            ],
            [
                'id' => 11,
                'profileId' => 1,
                'resource' => 'baseuser_auth',
                'action' => 'logout',
            ],
            [
                'id' => 12,
                'profileId' => 1,
                'resource' => 'user_user',
                'action' => 'index',
            ],
            [
                'id' => 13,
                'profileId' => 1,
                'resource' => 'user_user',
                'action' => 'create',
            ],
            [
                'id' => 14,
                'profileId' => 1,
                'resource' => 'user_user',
                'action' => 'edit',
            ],
            [
                'id' => 15,
                'profileId' => 1,
                'resource' => 'user_user',
                'action' => 'view',
            ],
            [
                'id' => 16,
                'profileId' => 1,
                'resource' => 'user_user',
                'action' => 'save',
            ],
            [
                'id' => 17,
                'profileId' => 1,
                'resource' => 'user_user',
                'action' => 'delete',
            ],
            [
                'id' => 18,
                'profileId' => 3,
                'resource' => 'shop_cart',
                'action' => 'index',
            ],
            [
                'id' => 19,
                'profileId' => 3,
                'resource' => 'shop_cart',
                'action' => 'add',
            ],
            [
                'id' => 20,
                'profileId' => 3,
                'resource' => 'shop_cart',
                'action' => 'remove',
            ],
            [
                'id' => 21,
                'profileId' => 3,
                'resource' => 'shop_cart',
                'action' => 'checkout',
            ],
        ];
        
        $permissions = $this->table('permissions');

        $permissions->insert($data)->save();
    }
}