<?php
declare(strict_types=1);

namespace Phlexus\Providers;

use Phlexus\Helpers;
use PHPMailer\PHPMailer\PHPMailer;
use ReCaptcha\ReCaptcha;
use ReCaptcha\RequestMethod\CurlPost;

class CaptchaProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected string $providerName = 'captcha';

    /**
     * Register application service.
     *
     * @param array $parameters Custom parameters for Service Provider
     * 
     * @return void
     */
    public function register(array $parameters = []): void
    {
        $application = Helpers::phlexusConfig('application')->toArray();

        $security = Helpers::phlexusConfig('security')->toArray();

        if (!isset($security[$this->providerName])) {
            return;
        }

        $configs = $security[$this->providerName];

        $this->di->setShared($this->providerName, function () use ($application, $configs) {
            $config = $configs['config'];

            $recaptcha = new ReCaptcha($config['secret'], new CurlPost);
            
            $parseUrl = parse_url($application['base_uri']);

            $host = isset($parseUrl['host']) ? $parseUrl['host'] : null;

            return $recaptcha->setExpectedHostname($host);
        });
    }
}
