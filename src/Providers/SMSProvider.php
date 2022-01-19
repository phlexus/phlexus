<?php
declare(strict_types=1);

namespace Phlexus\Providers;

use Phlexus\Helpers;
use PHPMailer\PHPMailer\PHPMailer;

class SMSProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'sms';

    /**
     * Register application service.
     *
     * @param array $parameters Custom parameters for Service Provider
     * @return void
     */
    public function register(array $parameters = []): void
    {
        $configs = Helpers::phlexusConfig($this->providerName)->toArray();
        $this->di->setShared($this->providerName, function () use ($configs) {
            $options = $configs['options'];

            $sid = $options['sid'];
            $token = $options['token'];

            $client = new Twilio\Rest\Client($sid, $token);

            return $client;
        });
    }
}
