<?php
declare(strict_types=1);

namespace Phlexus\Seeds;

use Phinx\Seed\AbstractSeed;
use Phlexus\Modules\BaseUser\Models\Profile;

final class ProfilesSeeder extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'name' => Profile::ADMIN,
                'active' => 1,
            ],
            [
                'id' => 2,
                'name' => Profile::MEMBER,
                'active' => 1,
            ],
            [
                'id' => 3,
                'name' => Profile::GUEST,
                'active' => 1,
            ],
        ];

        $profiles = $this->table('profiles');
        
        $profiles->insert($data)->save();
    }
}
