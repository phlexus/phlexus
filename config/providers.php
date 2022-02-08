<?php
declare(strict_types=1);

return [
    \Phlexus\Providers\AuthProvider::class,
    \Phlexus\Providers\RedisProvider::class,
    \Phlexus\Providers\TranslationProvider::class,
    \Phlexus\Providers\CaptchaProvider::class,
    \Phlexus\Providers\EmailProvider::class,
    //\Phlexus\Providers\SMSProvider::class, #Uncomment to enable sms
];
