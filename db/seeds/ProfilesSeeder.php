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
                'id' => Profile::ADMINID,
                'name' => Profile::ADMIN,
                'active' => 1,
            ],
            [
                'id' => Profile::MEMBERID,
                'name' => Profile::MEMBER,
                'active' => 1,
            ],
            [
                'id' => Profile::GUESTID,
                'name' => Profile::GUEST,
                'active' => 1,
            ],
        ];

        $profiles = $this->table('profiles');
        
        $profiles->insert($data)->save();
    }
}
