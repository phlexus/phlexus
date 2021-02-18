<?php
declare(strict_types=1);

namespace Phlexus\Seeds;

use Phinx\Seed\AbstractSeed;
use Phlexus\Modules\BaseUser\Models\Profiles;

final class ProfilesSeeder extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'name' => Profiles::ADMIN,
                'active' => 1,
            ],
            [
                'id' => 2,
                'name' => Profiles::MEMBER,
                'active' => 1,
            ],
            [
                'id' => 3,
                'name' => Profiles::GUEST,
                'active' => 1,
            ],
        ];

        $posts = $this->table('profiles');
        
        $posts->insert($data)->save();
    }
}
