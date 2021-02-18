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
                'resource' => 'users',
                'action' => 'index',
            ],
        ];
        
        $posts = $this->table('permissions');

        $posts->insert($data)->save();
    }
}