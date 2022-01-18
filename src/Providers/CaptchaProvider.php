<?php
declare(strict_types=1);

namespace Phlexus\Providers;

use Phlexus\Helpers;
use PHPMailer\PHPMailer\PHPMailer;
use ReCaptcha\ReCaptcha;

class CaptchaProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'captcha';

    /**
     * Register application service.
     *
     * @param array $parameters Custom parameters for Service Provider
     * @return void
     */
    public function register(array $parameters = []): void
    {
        $application = Helpers::phlexusConfig('application')->toArray();
        $configs = Helpers::phlexusConfig('captcha')->toArray();

        $this->di->setShared($this->providerName, function () use ($application, $configs) {
            $options = $configs['options'];
            $recaptcha = new ReCaptcha($options['secret']);
            
            $parse_url = parse_url($application['base_uri']);

            $host = isset($parse_url['host']) ? $parse_url['host'] : null;

            return $recaptcha->setExpectedHostname($host);
        });
    }
}
