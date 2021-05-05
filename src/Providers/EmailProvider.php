<?php
declare(strict_types=1);

namespace Phlexus\Providers;

use Phlexus\Helpers;
use PHPMailer\PHPMailer\PHPMailer;

class EmailProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'email';

    /**
     * Register application service.
     *
     * @param array $parameters Custom parameters for Service Provider
     * @return void
     */
    public function register(array $parameters = []): void
    {
        $configs = Helpers::phlexusConfig('email')->toArray();
        $this->di->setShared($this->providerName, function () use ($configs) {
            $mail = new PHPMailer();

            $options = $configs['options'];
            
            //Server settings
            $mail->isSMTP();
            $mail->Host       = $options['host'];
            $mail->Username   = $options['username'];
            $mail->Password   = $options['password'];
            $mail->Port       = $options['port'];

            if($options['is_smtp']) {
                $mail->SMTPAuth   = true;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            }

            $mail->setFrom($options['username'], $options['name']);

            return $mail;
        });
    }
}
