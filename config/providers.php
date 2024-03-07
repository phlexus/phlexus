<?php
declare(strict_types=1);

return [
    \Phlexus\Providers\AuthProvider::class,

    \Phlexus\Providers\SecurityLoaderProvider::class,

    \Phlexus\Providers\UserProvider::class,

    \Phlexus\Providers\ACLProvider::class,

    \Phlexus\Providers\MediaProvider::class,

    \Phlexus\Providers\RedisProvider::class,

    \Phlexus\Providers\TranslationProvider::class,

    \Phlexus\Providers\CaptchaProvider::class,

    \Phlexus\Providers\EmailProvider::class,

    //\Phlexus\Providers\SMSProvider::class, #Uncomment to enable sms

    \Phlexus\Providers\CartProvider::class,

    \Phlexus\Modules\Shop\Providers\PayPalProvider::class,
];
